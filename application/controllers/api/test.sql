CREATE TABLE `organization` (
    `id` int(10) NOT NULL,
    `org_id` varchar(100) NOT NULL,
    `org_name` varchar(10) NOT NULL,
    `org_country` varchar(10) NOT NULL,
    `org_state` varchar(40) NOT NULL,
    `org_district` varchar(30) NOT NULL,
    `org_city` varchar(30) NOT NULL,
    `org_pincode` varchar(30) NOT NULL,
    `org_address` varchar(100) NOT NULL,
    `org_email` varchar(30) NOT NULL,
    `org_No` varchar(100) NOT NULL,
    `org_addedby` varchar(100) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;


