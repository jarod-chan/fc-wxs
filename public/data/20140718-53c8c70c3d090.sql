


select personid,sum(win) as win,sum(draw) as draw,sum(lose) as lose from(
select colid as personid,if(val=1,1,0) as win,if(val=0,1,0) as draw,if(val=-1,1,0) as lose  from fycheck where chkid=7 and year=2012
 union all
select rowid as personid,if(-val=1,1,0)as win,if(val=0,1,0) as draw,if(-val=-1,1,0) as lose from fycheck where chkid=7 and year=2012
) as temp group by personid


select colid as personid,if(val=1,1,0) as win,if(val=0,1,0) as draw,if(val=-1,1,0) as lose  from fycheck where chkid=7 and year=2012
 union all
select rowid as personid,if(-val=1,1,0)as win,if(val=0,1,0) as draw,if(-val=-1,1,0) as lose from fycheck where chkid=7 and year=2012




select rowid as personid,if(-val=1,1,0)as win,if(val=0,1,0) as draw,if(-val=-1,1,0) as lose from fycheck where chkid=7 and year=2012


select * from fycheck where year=2012  and (rowid is null or colid is null or val is null)


select * from fycheck where chkid=70 and year=2012 order by id 


select * from fyperson where id='70'





select * from fycheck where chkid=70 and year=2012 and rowid=55 order by id 



select count(*) from fycheck where chkid=70 and year=2012  order by id 

select count(*) from fycheck where chkid=55 and year=2012  order by id 



select count(*) from fycheck where chkid=65 and year=2012  order by id 


select 498-378


select rowid,colid from fycheck






select * from fycheck where chkid=70 and year=2012 order by id 

select * from fycheck a,fycheck b where a.chkid=70 and a.year=2012 and b.chkid=70 and b.year=2012 and a.rowid=b.rowid and a.colid=b.colid
and a.id!=b.id


select id from fycheck where chkid=70 and year=2012 and id<=41215 order by id 




delete from fycheck where chkid=70 and year=2012 and id<=41215 



select * from fycheck where chkid=7 and year=2012 order by id 


select count(*) from fycheck where chkid=6 and year=2012 order by id 

select count(*) from fycheck where chkid=7 and year=2012 order by id 

select count(*) from fycheck where chkid=208 and year=2012 order by id 


select * from fycheck 
where chkid=7 and year=2012 
order by id 





select * from fycheck where year=2012  and (rowid is null or colid is null or val is null)

select * from fycheck where chkid=7 and year=2012 and val!=0 order by id 



select * from fycheck a,fycheck b where a.chkid=7 and a.year=2012 and b.chkid=7 and b.year=7 and a.rowid=b.rowid and a.colid=b.colid


select colid as personid,if(val=1,1,0) as win,if(val=0,1,0) as draw,if(val=-1,1,0) as lose  from fycheck where  year=2011
union all
select rowid as personid,if(-val=1,1,0)as win,if(val=0,1,0) as draw,if(-val=-1,1,0) as lose from fycheck where  year=2011

select colid as a,rowid as b,chkid as c from fycheck where year=2011
union all
select rowid,colid,chkid from fycheck where year=2011

select colid,count(colid) from (
select colid from fycheck where year=2011
union all 
select rowid from fycheck where year=2011
) temp
group by colid


select colid,count(colid) from (
select colid from fycheck where year=2012
union all 
select rowid from fycheck where year=2012
) temp
group by colid


select * from fyperson where id='48'



select 1190*2,756*2






