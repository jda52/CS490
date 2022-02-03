import mysql.connector
import os
import bcrypt

def hashPassword(password):
    hashedPassword = bcrypt.hashpw(password.encode(), bcrypt.gensalt())
    return hashedPassword

def checkPassword(results):
    for entry in results:
        hash = entry[1].encode()
        if bcrypt.checkpw(password.encode(), hash):
            return True
    return False

try:
    logincnx = mysql.connector.connect(host = "sql1.njit.edu", user= "jda52", password = "3Tdb$h90+&", database = "jda52")
    mycursor = logincnx.cursor()

    Username = "Jas672"
    password = 'N3*021F^*'

    query = "SELECT * FROM Login"
    mycursor.execute(query)

    results = mycursor.fetchall()
    print(checkPassword(results))
    
        
except mysql.connector.Error as err:
    print(err)
finally:
    try:
        logincnx
    except NameError:
        pass
    else:
        logincnx.close()