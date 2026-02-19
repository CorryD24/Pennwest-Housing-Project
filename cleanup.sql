-- This document is a series of SQL statements that clears out any additionally added rows to tables
-- and resets the auto increment values for the request tables to tidy things up after testing.
-- (IDs for other tables aren't displayed so it is unimportant to reset those).

-- ------------------------------------------------------------------------
-- Waitlist/room change requests:

DELETE FROM waitlist_request;

ALTER TABLE waitlist_request AUTO_INCREMENT = 1;

DELETE FROM room_change_request;

ALTER TABLE room_change_request AUTO_INCREMENT = 1;
-- ------------------------------------------------------------------------



-- ------------------------------------------------------------------------
-- Clear out extra buildings (all buildings as of 4/21/2025)
-- 	- Highlands 8 is the last building added to the DB with id = 23

DELETE FROM buildings_room_types_llcs WHERE building_id > 23;

DELETE FROM buildings_room_types WHERE building_id > 23;

DELETE FROM buildings_llcs WHERE building_id > 23;

DELETE FROM building WHERE id > 23;
-- ------------------------------------------------------------------------



-- ------------------------------------------------------------------------
-- Clear out extra room types (all room types as of 4/21/2025)
-- 	- Studio Double is the last room type added to the DB with id = 17

DELETE FROM buildings_room_types_llcs WHERE room_type_id > 17;

DELETE FROM rooms_llcs WHERE room_type_id > 17;

DELETE FROM buildings_room_types WHERE room_type_id > 17;

DELETE FROM room_type WHERE id > 17;
-- ------------------------------------------------------------------------



-- ------------------------------------------------------------------------
-- Clear out extra LLCs/Themed Housing (all LLCs as of 4/21/2025)
-- 	- Outdoors is the last LLC added to the DB with id = 11

DELETE FROM buildings_room_types_llcs WHERE llc_id > 11;

DELETE FROM rooms_llcs WHERE llc_id > 11;

DELETE FROM buildings_llcs WHERE llc_id > 11;

DELETE FROM llc WHERE id > 11;
-- ------------------------------------------------------------------------