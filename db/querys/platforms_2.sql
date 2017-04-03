select * from repair_stuff.gostost;
select * from repair_stuff.work_sections;
select * from repair_stuff.repair_jobs;
select * from repair_stuff."Consumables";
select * from repair_stuff.doc_type;
select * from repair_stuff.rep_jobs_docs;

delete from repair_stuff.work_sections where id > 2;

insert into repair_stuff.rep_jobs_docs ( job_id, doc_type )
select rj.id, dt.id
from repair_stuff.work_sections ws,
	repair_stuff.repair_jobs rj,
	repair_stuff.doc_type dt
where rj."name" = 'Установка домкратов'
and rj.razdel = 2
and dt.code = 'ar'
;


delete from repair_stuff."Consumables" where id > 0 ;

insert into repir_stuff.work_sections
( name, weight )
values ( 'Раздел 2', 333 )
;

insert into repair_stuff.repair_jobs ( razdel, subparagraph, name, work_doc_type, replacement )
select ws.id, '1.1', 'Имя работы', wt.id, true
from repair_stuff.work_sections ws, repair_stuff.doc_type wt
where ws."name" = 'Подготовительные работы'
and wt.code = 'other'
;

insert into repair_stuff."Consumables" ( id_work, name, mark, consumption_rate )
select rj.id, 'Имя детали', 'Ст3', '12'
from repair_stuff.repair_jobs rj
where rj."name"='Отчистка деталей и сборочных едениц от грязи, старой отслоившейся краски и ржавчины'
;

insert into repair_stuff.gostost ( det_id, name )
select con.id , 'ГОСТ 42165-55'
from repair_stuff."Consumables" con
where con."name" = 'Средство моющее Омега-1'
;
insert into repair_stuff.gostost ( det_id, name ) values ( 2 , 'ГОСТ 1' );



