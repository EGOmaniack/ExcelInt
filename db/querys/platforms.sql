select * from staff.w_position;
select * from staff.employees where surname='Кудряшов';
select * from platforms.platforma;
select * from firms.companies;
select * from platforms.repair;
select * from platforms.repair_type;
select * from staff.workshop;
select * from staff.employees where surname = 'Кривошеев';

insert into staff.workshop ( emp_id )
select p.id
from staff.employees p
where p.surname = 'Кудряшов'
and substring(p.name from 1 for 1) = substring('И.В.' from 1 for 1)
;

delete from platforms.repair
where id=1
;

delete from staff.workshop where id > 0;

select "number" from firms.companies;

update platforms.repair set repair_start = '', repair_end = '2005-06-01', repair_type  = ( select id from platforms.repair_type where code = 't1' ) where id = 15;

update platforms.repair
set repair_start = '01.06.2000', repair_end = '01.06.2005' , repair_type  = 
( select id from platforms.repair_type where code = 't1' )
where id=15;

insert into staff.employees ( personal_number, surname, name, middle_name ,position, bday)
select  1, 'Примаков', 'Александр', '', p.id  , '18.08.1987'
from staff.w_position p
where p.worker_position = 'Инженер I категории'
;/*Пример вставки в сотрудники*/
delete from staff.employees where personal_number = 1; /*удаление примера*/

select emp.id, emp.personal_number, emp.surname, emp.name, emp.middle_name "Отчество", p.worker_position "Должность", emp.bday "Дата рождения"
from staff.employees emp, staff.w_position p
where emp.position=p.id
and emp.surname='Примаков'
order by emp.surname desc
;

select p.name, r.id, p."number",comp3."name" "repair_company_name" , 
comp2."name" "fac_name", comp."number" "owner", p.factory_number, 
p.release_date, p.last_repair, rtype2."type" "last_rep_type", 
p.full_name ,rtype."type" "repair_type", r.repair_start, r.repair_end, r.other_info
, to_char( p.last_repair , 'DD.MM.YYYY г.') "last_repair_date"
, rtype.code "repaire_type_code"
from platforms.platforma p, 
firms.companies comp3, 
firms.companies comp, 
firms.companies comp2, 
platforms.repair r, 
platforms.repair_type rtype, 
platforms.repair_type rtype2 
where p.owner=comp.id 
and r.repair_copmany = comp3.id 
and p.last_rep_type = rtype2.id 
and r.repair_type = rtype.id 
and p.factory_name = comp2.id 
and p.id = r.platform_id 
order by p.id 
;

select p.name, comp2."name" "fac_name", p.number "pms" ,comp.number, comp.name, p.factory_number, p.release_date, p.last_repair, reptype.type
from platforms.platforma p, firms.companies comp, platforms.repair_type reptype, firms.companies comp2
where p.owner=comp.id
and p.last_rep_type=reptype.id
and p.factory_name=comp2.id
order by p.id
;

--insert into platforms.platforma ( name, number, factory_number, release_date )
--values ( 'ППК-3В' );

insert into platforms.platforma (number) values (2);
select * from platforms.platforma;
select * from platforms.repair;

select r.repair_start, r.repair_end, p."number", c."name" "Организация", t."type" "Тип ремонта", r.operating_after_last_repair , r.other_info
from platforms.repair r, platforms.repair_type t, platforms.platforma p, firms.companies c
where r.platform_id=p.id
and r.repair_copmany=c.id
and r.repair_type=t.id
;

insert into platforms.repair ( platform_id, repair_type, repair_start )
select p.id, t.id, now()
from platforms.platforma p, platforms.repair_type t
where p.number=778
and t."code"='t1'
;

--insert into platforms.platforma ( name, number, owner)
--select

update platforms.platforma
set (factory_number, last_repair, release_date ) = (926, '01.08.1990', '01.06.2003')
where number=42;

update platforms.platforma
set factory_name = 'Платформа механизированная'
where id>0
;
update platforms.platforma
set number = 42
where number = 4236
;

delete from platforms.platforma where number=124121;


delete from firms.companies where id > 3;




