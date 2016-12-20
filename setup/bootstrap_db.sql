CREATE TABLE request (
    request_id integer PRIMARY KEY AUTOINCREMENT,
    hostname text NOT NULL,
    ip_address text NOT NULL,
    request_type text NOT NULL,
    os text NOT NULL,
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX request_hostname_indx ON request(hostname);
CREATE INDEX request_ipaddr_indx ON request(ip_address);
CREATE INDEX request_reqtype_indx ON request(request_type);

