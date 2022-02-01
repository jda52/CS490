import mysql.connector

try:
    logincnx = mysql.connector.connect(host = "sql1.njit.edu", user= "jda52", password = "3Tdb$h90+&", database = "jda52")
    mycursor = logincnx.cursor()
    mycursor.execute("SHOW COLUMNS FROM Login")
    result = mycursor.fetchall()

    for field in result:
        print(field)

except mysql.connector.Error as err:
    print(err)
finally:
    try:
        logincnx
    except NameError:
        pass
    else:
        logincnx.close()