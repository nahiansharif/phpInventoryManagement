#!/usr/bin/python -u
import matplotlib
matplotlib.use('Agg')  # Use non-interactive backend
import matplotlib.pyplot as plt
import mysql.connector


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


def generatePieChart(labels, sizes, colors, title="Plane Conditions", filename="C:/xampp/htdocs/plane_inventory_management/phpInventoryManagement/python/pieChart2.png"): 
    
    plt.figure(figsize=(8, 8))
    plt.pie(sizes, labels = labels, colors=colors, autopct='%1.1f%%', startangle=140)
    plt.title(title)
    plt.axis('equal')
    plt.savefig(filename)
    plt.close()


chart_labels = ['Good Planes', 'Low Fuel', 'Bad Engine', 'Bad Tire', '2 or more problems']
chart_sizes = [goodPlanes, lowFuel, badEngine, badTire, moreProblems]
colors = ['#4CAF50', '#FFC107', '#FF5722', '#F44336', '#ce0f01']
print(displayData)
generatePieChart(chart_labels, chart_sizes, colors)
myDB.close()
    






