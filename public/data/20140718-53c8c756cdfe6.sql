
select * from am_yearchkstate

select * from fyperson where  manage='N' and state='valid'
and id not in(
  select personid from am_yearchkstate
)

 select personid from am_yearchkstate where am_yearchkstate.checkState!='commit'
 
 
 
 
select name,department from fyperson where  manage='N' and state='valid'
and id not in(
  select personid from am_yearchkstate where checkState='commit'
)


select * from Fychkmange

select personid from Fychkmange where year=2012

select name,department from fyperson where  manage='N' and state='valid'
and id not in(
   select distinct personid from Fychkmange where year=2012
)




