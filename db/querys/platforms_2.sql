select * from repair_stuff.gostost;
select id, name from repair_stuff.work_sections;
select * from repair_stuff.repair_jobs rj; where rj."name"= 'Восстановление элементов металлоконструкции рамы пораженные коррозией менее чем на 20% толщины поперечного сечения зачисткой до металического блеска';
select * from repair_stuff."Consumables" order by id_work;
select * from repair_stuff.doc_type;
select * from repair_stuff.rep_jobs_docs;
select * from repair_stuff.smazka;

--Упрощеный insert в работы
insert into repair_stuff.repair_jobs ( razdel, name )
values ( 3, 'name' )
;

-- insert в работы
insert into repair_stuff.repair_jobs ( razdel, subparagraph, name, *work_doc_type, replacement )
select ws.id, '1.1', 'Имя работы', wt.id, true
from repair_stuff.work_sections ws, repair_stuff.doc_type wt
where ws."name" = 'Подготовительные работы'
and wt.code = 'other'
;

--insert для смазки 
insert into repair_stuff.smazka ( job_id, points_count, gsm_name, lub_method, mass )
select rj.id, 22, 'Солидол', 'Смазать', 12
from repair_stuff.repair_jobs rj
where rj."name" = 'Дефектный сигнал отремонтировать или заменить'
;


insert into repair_stuff."Consumables" ( id_work, name, mark, consumption_rate, unit, size, gostost )
select rj.id, 'Втулкаa', 'Ст3', '12', 'кг', '2x2', 'Г2'
from repair_stuff.repair_jobs rj
where rj."name"='Восстановление элементов металлоконструкции рамы пораженные коррозией менее чем на 20% толщины поперечного сечения зачисткой до металического блеска'
and rj.razdel = getWorkSection('Рама')
;

delete from repair_stuff.repair_jobs;

-- insert в таблицу где связаны 
insert into repair_stuff.rep_jobs_docs ( job_id, doc_type )
select rj.id, dt.id
from repair_stuff.repair_jobs rj,
	repair_stuff.doc_type dt
where rj."name" = 'Установка домкратов'
and rj.razdel = getWorkSection('Разборка платформы')
and dt.code = 'ar'
;


select getWorkSection('Разборка платформы');




delete from repair_stuff."Consumables" where id > 0 ;

insert into repir_stuff.work_sections
( name, weight )
values ( 'Раздел 2', 333 )
;


insert into repair_stuff.gostost ( det_id, name )
select con.id , 'ГОСТ 42165-55'
from repair_stuff."Consumables" con
where con."name" = 'Средство моющее Омега-1'
;
insert into repair_stuff.gostost ( det_id, name ) values ( 2 , 'ГОСТ 1' );



