create event periodic_reset ON SCHEDULE EVERY 22 DAY_HOUR
COMMENT 'Reset time on 10 am daily'
DO update current_place set time_of_entry=now();