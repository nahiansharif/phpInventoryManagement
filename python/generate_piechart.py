#!/usr/bin/python -u
import mysql.connector
import matplotlib.pyplot as plt
import base64
from io import BytesIO


myDB = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="Silvee",
        port=3306

    )

    


    # fuel < 50k is bad
    # good tire < 4 is bad
    # engine != good is bad

    # SELECT fuel, tire1, tire2, tire3, tire4, tire5, tire6, motor FROM `plane`

myCursor = myDB.cursor() 

myCursor.execute("SELECT fuel, motor, tire1, tire2, tire3, tire4, tire5, tire6 FROM `plane`")
    #                         0       1     2      3      4      5      6      7

data = myCursor.fetchall()

totalNumOfPlanes = len(data)
goodPlanes = 0
badPlanes = 0
lowFuel = 0; 
badEngine = 0
badTire = 0 
moreProblems = 0

goodTireNum = 0

    #use hashmap to 

for row in data:
    for i in range(2, 8):
        if row[i] == 'Good':
             goodTireNum += 1

    if row[0] < 50000 or row[1] != 'Good' or goodTireNum < 4:
        badPlanes += 1
        if row[0] < 50000 and row[1] == 'Good' and goodTireNum >= 4:
            lowFuel += 1
        elif row[1] != 'Good' and row[0] >= 50000 and goodTireNum >= 4:
            badEngine += 1
        elif goodTireNum < 4 and  row[0] >= 50000 and row[1] == 'Good':
            badTire += 1
        else:
            moreProblems += 1

    else:
        goodPlanes += 1
    goodTireNum = 0

def roundNum(num):
    return round(num/totalNumOfPlanes, 3)*100

displayData = f"Good Planes: {roundNum(goodPlanes)}|Low Fuel: {roundNum(lowFuel)}|Bad Engine: {roundNum(badEngine)}|Bad Tires: {roundNum(badTire)}|More Problems: {roundNum(goodPlanes)}"


labels = ['Good', 'Low Fuel', 'Bad Engine', 'Bad Tire', '2 or more problems']
data  = [goodPlanes, lowFuel, badEngine, badTire, moreProblems]
colors = ['#4CAF50', '#FFC107', '#FF5722', '#F44336', '#ff0000']

# Generate plot
plt.figure(figsize=(8,6))
plt.pie(data, labels=labels, autopct='%1.1f%%')
plt.title('Plane Conditions')

# Save to buffer
buffer = BytesIO()
plt.savefig(buffer, format='png')
plt.close()

# Return base64
print(base64.b64encode(buffer.getvalue()).decode('utf-8'))

# print(displayData)

myDB.close()
    






