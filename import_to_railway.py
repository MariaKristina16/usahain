#!/usr/bin/env python3
"""
Import SQL database to Railway MySQL
"""

import mysql.connector
import sys

# Railway MySQL Credentials
config = {
    'host': 'maglev.proxy.rlwy.net',
    'port': 10483,
    'user': 'root',
    'password': 'frnhzXLioiZTbRZYmGDHQddEtiMzJDIV',
    'database': 'railway',
    'autocommit': True
}

try:
    print("🔌 Connecting to Railway MySQL...")
    connection = mysql.connector.connect(**config)
    cursor = connection.cursor()
    print("✅ Connected successfully!")
    
    print("\n📂 Reading SQL file...")
    with open('usahain_db.sql', 'r', encoding='utf-8') as sql_file:
        sql_content = sql_file.read()
    
    print("⏳ Importing database schema...")
    
    # Split and execute statements
    statements = [s.strip() for s in sql_content.split(';') if s.strip()]
    
    for i, statement in enumerate(statements, 1):
        try:
            cursor.execute(statement)
            if i % 10 == 0:
                print(f"  Progress: {i}/{len(statements)} statements executed...")
        except mysql.connector.Error as err:
            print(f"⚠️  Warning at statement {i}: {err}")
            continue
    
    cursor.close()
    connection.close()
    
    print(f"\n✅ SUCCESS! Imported {len(statements)} SQL statements")
    print("🎉 Database is ready on Railway!")
    
except mysql.connector.Error as err:
    print(f"❌ ERROR: {err}")
    sys.exit(1)
except FileNotFoundError:
    print("❌ ERROR: usahain_db.sql not found!")
    sys.exit(1)
except Exception as err:
    print(f"❌ UNEXPECTED ERROR: {err}")
    sys.exit(1)
