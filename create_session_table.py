import mysql.connector

config = {
    'host': 'maglev.proxy.rlwy.net',
    'port': 10483,
    'user': 'root',
    'password': 'frnhzXLioiZTbRZYmGDHQddEtiMzJDIV',
    'database': 'railway',
    'autocommit': True
}

try:
    conn = mysql.connector.connect(**config)
    cursor = conn.cursor()
    
    cursor.execute('DROP TABLE IF EXISTS ci_sessions')
    cursor.execute('''CREATE TABLE ci_sessions (
        id varchar(128) NOT NULL PRIMARY KEY,
        ip_address varchar(45) NOT NULL,
        timestamp int(10) unsigned DEFAULT 0 NOT NULL,
        data longblob NOT NULL,
        KEY ci_sessions_timestamp (timestamp)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4''')
    
    print('✅ Session table created/verified')
    cursor.close()
    conn.close()
except Exception as e:
    print(f'Error: {e}')
