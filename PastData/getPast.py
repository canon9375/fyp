from pymongo import MongoClient
from dateutil.parser import parse
import datetime
import json
from datetime import date, timedelta
import sys
conn=MongoClient('mongodb://admin:admin@cluster0-shard-00-00-9eks9.mongodb.net:27017,cluster0-shard-00-01-9eks9.mongodb.net:27017,cluster0-shard-00-02-9eks9.mongodb.net:27017/test?ssl=true&replicaSet=Cluster0-shard-0&authSource=admin&retryWrites=true')
ft = conn.fyp.airPollution
actual = conn.fyp.currentAQHI
t1 = datetime.datetime.now() -timedelta(hours=73)
locat = "Central/western"
if len(sys.argv) > 1:
    locat = sys.argv[1]
result = ft.find({"dateTime":{"$gt":t1},"location":locat}).sort("dateTime",-1).limit(72)
reJson = {}
if result.count()!=0:
    for a in result: 
        loca = a['location']
        fmt = a['dateTime'].strftime('%Y-%m-%d %H')
        time = parse(fmt)-timedelta(hours=0.5)
        reJson[fmt]=[]
        result2 = actual.find_one({"time":{"$eq":time},"locationCode":a['locationCode']})
        if result2 != None:
            actAqhi = result2['aqhi']
        else:
            actAqhi = '3'  
        reJson[fmt].append(a['NO2'])
        reJson[fmt].append(a['O3'])
        reJson[fmt].append(a['SO2'])
        reJson[fmt].append(a['CO'])
        reJson[fmt].append(a['PM10'])
        reJson[fmt].append(a['PM25'])
        reJson[fmt].append(actAqhi)
#         reJson[fmt]={a['NO2'],a['O3'],a['SO2'],a['CO'],a['PM10'],a['PM25'],actAqhi}
else:
    result = ft.find({"dateTime":{"$gt":t1},"location":"Central/western"}).sort("dateTime",-1).limit(73)
    for a in result: 
        loca = a['location']
        fmt = a['dateTime'].strftime('%Y-%m-%d %H')
        time = parse(fmt)-timedelta(hours=0.5)
        reJson[fmt]=[]
        result2 = actual.find_one({"time":{"$eq":time},"locationCode":a['locationCode']})
        if result2 != None:
            actAqhi = result2['aqhi']
        else:
            actAqhi = '3'  
        reJson[fmt].append(a['NO2'])
        reJson[fmt].append(a['O3'])
        reJson[fmt].append(a['SO2'])
        reJson[fmt].append(a['CO'])
        reJson[fmt].append(a['PM10'])
        reJson[fmt].append(a['PM25'])
        reJson[fmt].append(actAqhi)
#         reJson[fmt]={a['NO2'],a['O3'],a['SO2'],a['CO'],a['PM10'],a['PM25'],actAqhi}
print(reJson)

