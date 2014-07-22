

select * from fyperson 

select * from  am_personsummary;


select personId from am_personsummary where am_personsummary.summaryEnum='commit';

select * from fyperson 
where (manage='y' or manage='N') and id not in(select personId from am_personsummary where am_personsummary.summaryEnum='commit')
and state='valid' 
order by id



