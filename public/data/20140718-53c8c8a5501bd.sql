/*
2013年绩效考核结果
mysql 临时表不能在一次查询中连续引用两次
select a.id,b.id from rpt a,rpt b where a.id=b.id会出错
*/

drop procedure if exists yearchk2013;
create procedure yearchk2013 (in  i_year bigint(20))
begin
  
  declare Vdigits int(10); --  小数位数
  set Vdigits=6;
  
  
  drop table if exists rpt;
  create temporary table rpt  
  (  
   id int(12) not null default '0',
   name varchar(20) default null,
   department varchar(255) default null,
   no int(12) default null,-- 最后序号
   scheck decimal(10,6) default null,-- 部门经理得分
   mdep decimal(10,6) default null,-- 部门平均得分
   mall decimal(10,6) default null,-- 总平均
   stotal decimal(10,6) default 150,
   s decimal(10,6) default null, -- s:计算中间值
   savg decimal(10,6) default null, -- s平均值
   damp decimal(10,6) default null,-- 部门分值幅度
   mamp decimal(10,6) default null,-- 总体分值幅度
   alpha decimal(10,6) default null,-- 中间参数
   upsilon decimal(10,6) default null,-- 中间参数
   val decimal(10,6) default null,-- 横向得分
   vavg decimal(10,6) default null,-- v的平均值
   iavg decimal(10,6) default null,-- 平均参与度
   iabs decimal(10,6) default null,-- 绝对参与度
   idir decimal(10,6) default null,-- 有想参与度
   ibeta decimal(10,6) default 0.2,-- 参与度参数
   iv decimal(10,6) default null,-- 参与度得分
   result decimal(10,6) default null,-- 计算结果
   primary key (id)
  ) engine = memory;
  
  -- 插入人员姓名和部门得分
  insert into rpt(id,name,department,scheck)
  select person.id,person.name,person.department,realpt from fyperson person,(select a.personid,round(sum(a.val*b.point)/5,Vdigits) as realpt 
  from fychkmange a,fychkitem b where a.itemid=b.id and a.year=i_year group by a.personid) temp 
  where person.id=temp.personid order by person.id asc;
  
  
  
  -- 计算部门平均
  begin
    declare Vdepartment varchar(255) default null;-- 部门
    declare Vmdep decimal(10,6) default null;-- 部门平均分
    declare done int(10) default false;-- 遍历数据结束标志
    
    declare cur_dep cursor for select department,sum(scheck)/count(id) as mdep from rpt group by department;
    declare continue handler for not found set done = true;
   
    open cur_dep;
    mdep_loop: loop
      fetch cur_dep into Vdepartment,Vmdep;
      if done then 
        leave mdep_loop;
      end if;
      update rpt set mdep=Vmdep where rpt.department=Vdepartment;
    end loop;
    close cur_dep;
  end;
  
  -- 计算总体平均
  begin
    declare Vmall decimal(10,6);
    select sum(scheck)/count(id) into Vmall from rpt;
    update rpt set mall=Vmall;
  end;
  
  
  /**
	 * 根据提供的值，计算s 公式如下
	 * [Scheck+(Mall-Mdep)]/Stotal
	 *					          
	 * 个人得分   + ( 员工平均得分 - 部门平均分 )			
	 * -----------------------------------
	 * 				总分
	 */
  update rpt set s=round((scheck+mall-mdep)/stotal,Vdigits);
  
  -- 计算s平均值savg
  begin
    declare Vsavg decimal(10,6);
    select sum(s)/count(id) into Vsavg from rpt;
    update rpt set savg=Vsavg;
  end;
   
  -- 部门分值幅度
   begin
       declare Vdepartment varchar(255) default null;-- 部门
       declare Vdamp decimal(10,6) default null;-- 部门平均分
       declare done int(10) default false;-- 遍历数据结束标志
       
       declare cur_damp cursor for select department,round(max(scheck)-min(scheck),Vdigits) as damp from rpt group by department;
       declare continue handler for not found set done = true;
       
       open cur_damp;
       damp_loop:loop
         fetch cur_damp into Vdepartment,Vdamp;
         if done then 
            leave damp_loop;
         end if;
         update rpt set damp=Vdamp where department=Vdepartment;
       end loop;
       close cur_damp;
    
   end;
  
  -- 公司平均分值幅度
  -- 幅度为0的部门不计算在内
  begin
    declare Vdamp decimal(10,6) default null;-- 部门平均分
    declare Vtotal decimal(10,6) default 0;-- 总分
    declare Vnum int(10) default 0;-- 个数
    
    declare done int(10) default false;-- 遍历数据结束标志
    declare cur_damp cursor for select round(max(scheck)-min(scheck),Vdigits) as damp from rpt group by department;
    declare continue handler for not found set done = true;
    
    open cur_damp;
    damp_loop : loop
      fetch cur_damp into Vdamp;
      if done then 
        leave damp_loop;
      end if;
      if Vdamp>0 then
        set Vtotal=Vtotal+Vdamp;
        set Vnum=Vnum+1;
      end if;
    end loop;
    close cur_damp;
    
    update rpt set mamp=round(Vtotal/Vnum,Vdigits);
    
  end;
  
  -- 计算upsilon
  -- alpha=Mamp/Stotal;
  -- (S-Savg)*alpha*100
  begin
    update rpt set alpha=round(mamp/stotal,Vdigits);
    update rpt set upsilon=round((s-savg)*alpha*100,Vdigits);
  end;
  
  -- 计算横向评价得分
  begin
    declare Vid int(12) default null;
    declare Vval decimal(10,6) default null;
    
    declare done int(10) default false;-- 遍历数据结束标志
    declare cur_val cursor for select personid,round(sum(val)/count(personid)/2*100,Vdigits) from (
        select colid as personid, val+1 as val from fycheck where year=i_year
        union all
        select rowid as personid,-val+1 as val from fycheck where year=i_year 
    )temp group by personid;
    declare continue handler for not found set done = true;
    
    open cur_val;
    val_loop:loop
      fetch cur_val into Vid,Vval;
      if done then
        leave val_loop;
      end if;
      update rpt set val=Vval where id=Vid;
    end loop;
    close cur_val;
  end;
  

  -- 计算val的平均值
  begin
    declare Vvavg decimal(10,6);
    select round(sum(ifnull(val,0))/count(id),Vdigits) into Vvavg from rpt;
    update rpt set vavg=Vvavg;
  end;

  
  -- 平均参与度
  begin
    declare Viavg decimal(10,6);
    select round(sum(abs(val))/count(id),Vdigits) into Viavg from fycheck where year=i_year;
    update rpt set iavg=Viavg;
  end;
  
  -- 绝对参与度
  begin
    declare Vid int(12) default null;
    declare Viabs decimal(10,6) default null;
    
    declare done int(10) default false;-- 遍历数据结束标志
    declare cur_iabs cursor for select chkid,round(sum(abs(val))/count(id),Vdigits) from fycheck where year=i_year group by chkid;
    declare continue handler for not found set done = true;
    
    open cur_iabs;
    iabs_loop:loop
      fetch cur_iabs into Vid,Viabs;
      if done then 
        leave iabs_loop;
      end if;
      update rpt set iabs=Viabs where id=Vid;
    end loop;
    close cur_iabs;
    
  end;
  
  -- 有向参与度
  -- idir=iabs-iavg
  -- iv=idir*ibeta
  update rpt set idir=ifnull(iabs,0)-ifnull(iavg,0);
  update rpt set iv=round(vavg*idir*ibeta,Vdigits);
  
  
  
  --   result=upsilon+val;
  update rpt set result=upsilon+ifnull(val,0)+iv;
  
 
   -- 更新序号
   begin
    declare Vno int(12) default 0;
    declare Vid int(12) default null;
    
    declare done int(10) default false;-- 遍历数据结束标志
    declare cur_no cursor for select id from rpt order by result desc;
    declare continue handler for not found set done = true;
    
    open cur_no;
    no_loop:loop
      fetch cur_no into Vid;
      if done then 
        leave no_loop;
      end if;
      set Vno=Vno+1;
      update rpt set no=Vno where id=Vid;
    end loop;
    close cur_no;
    
   end;
  
  select * from rpt order by no;
  truncate table rpt; 
end;

call yearchk2013(2013);




