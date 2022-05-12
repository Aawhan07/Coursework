--sql script
--creating database---------

1. create database weatherapp;
--creating table---------------

2. create table weather(weather_condition varchar(80), temperature float(20), wind_speed float(20), weather_datetime datetime not null, pressure int(20), humidity int(20), city varchar(80));
--inserting the values in the table---------------
3. INSERT INTO  weather(weather_condition, temperature, wind_speed, weather_datetime, pressure, humidity, city) VALUES('scattered clouds',-8.83,3.09,3.09, '2022-01-04 02:51:23', 1017, 78, 'Tucson', -5.86,-12.75,'03n');

