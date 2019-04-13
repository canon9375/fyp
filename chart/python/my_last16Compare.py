import pymongo
from pymongo import MongoClient
from dateutil.parser import parse
import datetime
import json
from datetime import date, timedelta
conn=MongoClient('mongodb://admin:admin@cluster0-shard-00-00-9eks9.mongodb.net:27017,cluster0-shard-00-01-9eks9.mongodb.net:27017,cluster0-shard-00-02-9eks9.mongodb.net:27017/test?ssl=true&replicaSet=Cluster0-shard-0&authSource=admin&retryWrites=true')
predict = conn.fyp.predictData
actual = conn.fyp.currentAQHI
location = ['Central/western','Eastern','Kwun Tong','Sham Shui Po',
                'Kwai Chung','Tsuen Wan','Tseung Kwan O','Yuen Long',
                'Tuen Mun','Tung Chung','Tai Po','Sha Tin',
                'Tap Mun','Causeway Bay','Central','Mong Kok'] 
reJson = {}
for x in location:
    result = predict.find({"location":x}).sort("dateTime",-1).limit(10)
    reJson[x]=[]
    for a in result: 
        loca = a['location']
        preAqhi = a['paqhi']
        fmt = a['dateTime'].strftime('%Y-%m-%d %H')
        time = parse(fmt)+ timedelta(hours=0.5)
        result2 = actual.find_one({"time":{"$eq":time},"locationCode":a['locationCode']})
        actAqhi=''
        if result2 != None:
            actAqhi = str(result2['aqhi'].replace(' ',''))
        else:
            actAqhi = '3'
        reJson[x].append({"actAqhi":actAqhi,"preAqhi":preAqhi})
print(reJson)

