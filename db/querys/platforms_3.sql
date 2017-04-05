select * from repair_stuff.work_sections;
select * from repair_stuff.repair_jobs;
select * from repair_stuff.rep_jobs_docs;

delete from repair_stuff.repair_jobs *;

insert into repair_stuff.work_sections ( name, weight, r_type_id, platform_type_id, parent_sec )
select 'test', 10, rt.id, 1, parent.id
from platforms.repair_type rt, 
repair_stuff.work_sections parent
where rt.code = 't2'
and parent.name = 'main_t1'
;

delete from repair_stuff.work_sections
where name='test'
;

--r_type_id = 2
--platform_type_id = 1