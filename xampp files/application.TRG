TYPE=TRIGGERS
triggers='CREATE DEFINER=`` TRIGGER `check_client_allowance`\nBEFORE INSERT ON `application` FOR EACH ROW\nBEGIN\nIF NOT reg_status(NEW.client_id) THEN\nSIGNAL SQLSTATE \'45000\'\nSET MESSAGE_TEXT = \'The client cannot fill the application as he/she has not registered\';\nEND IF;\nEND'
sql_modes=1098907648
definers='@'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci'
created=163670939562
