locaList=[['causewaybay',22.2801379,114.1829043],['central',22.2818189,114.1559413]
        , ['central/western',22.317831,114.194941], ['eastern',22.2477915,114.1496074]
        ,['kwaichung',22.3283503,114.0142057],['kwuntong',22.3133199,114.2226423]
            ,['mongkok',22.3226159,114.1660853],['shamshuipo',22.3302309,114.1569233]
                ,['shatin',22.3762849,114.1823453],['',9],['taipo',22.4509649,114.1623843]
                ,['tapmun',22.4713209,114.3585323],['tseungkwano',22.3261644,114.1147959]
                ,['tsuenwan',22.3260131,114.114796],['tuenmun',22.4181877,113.9821814]
                ,['tungchung',22.2888939,113.9414723],['yuenlong',22.4451599,114.0204623]]
from pymongo import MongoClient
import numpy as np
import datetime
from dateutil.parser import parse
from datetime  import date, timedelta
import json
client=MongoClient('mongodb://admin:admin@cluster0-shard-00-00-9eks9.mongodb.net:27017,cluster0-shard-00-01-9eks9.mongodb.net:27017,cluster0-shard-00-02-9eks9.mongodb.net:27017/test?ssl=true&replicaSet=Cluster0-shard-0&authSource=admin&retryWrites=true')
db=client.fyp
data=db.samkiPredictorData
history=[]
time=[]
    # now
t =  datetime.datetime.now()
fmt = t.strftime('%Y-%m-%d %H:30')
time = parse(fmt)
perferD={}

def getAQHI(count):
    aqhi=[]
    result=[]
    reData =[]
#     print(time)
    t =  datetime.datetime.now() + timedelta(hours=count)
    minu = int(t.strftime('%M'))

    if minu<30:
        t =  datetime.datetime.now() - timedelta(hours=(1))
        fmt = t.strftime('%Y-%m-%d %H:30')
    else:
         fmt = t.strftime('%Y-%m-%d %H:30')

    time = parse(fmt)
    with open('ARIMA.json', 'r') as outfile:
        LanLo100= json.load(outfile)
    pInput = []
    for i in LanLo100:
        pInput.append(i['center'])

    for i in range (len(LanLo100)):
        myquery = { "location": locaList[i][0] ,"time":time }
        Central = data.find(myquery)
        if Central.count() == 0:
            result=float(3)
        else:
            for a in Central:
                result=a['aqhi']
#         try:
#             for a in Central:

#         except:

        annAqhi =result
        LanLo100[i]['center'].append(str(annAqhi))
        LanLo100[i]['center'].append(1)
        reData.append(LanLo100[i]['center'])
#     print(LanLo100[i]['center'])
    return reData

# #0
# perferD[fmt] =getAQHI(0)
# print(perferD)
#1
def getCurrent():
    db=client.fyp
    data=db.currentAQHI
    t =  datetime.datetime.now()
    reData =[]
    minu = int(t.strftime('%M'))
    if minu<30:
        t =  datetime.datetime.now() - timedelta(hours=(1))
        fmt = t.strftime('%Y-%m-%d %H:30')
    else:
        fmt = t.strftime('%Y-%m-%d %H:30')

    time = parse(fmt)
    with open('ARIMA.json', 'r') as outfile:
        LanLo100= json.load(outfile)
    pInput = []
    for i in LanLo100:
        pInput.append(i['center'])

    for i in range (len(LanLo100)):
        myquery = { "locationCode": i , "time":time}
        Central = data.find(myquery)
        result=float(4)
        if Central.count() == 0:
            result=float(4)
        else:
            for a in Central:
                result=int(a['aqhi'])
        annAqhi =result
        LanLo100[i]['center'].append(str(annAqhi))
        LanLo100[i]['center'].append(1)
        reData.append(LanLo100[i]['center'])
#     print(LanLo100[i]['center'])
    return reData

def time(count):
    t =  datetime.datetime.now() + timedelta(hours=count)
    fmt = t.strftime('%Y-%m-%d %H:30')
    return fmt

#now
perferD[time(0)] =getCurrent()

# print(perferD)
#1
perferD[time(1)] =getAQHI(1)
# print(perferD)
#2
perferD[time(2)] =getAQHI(2)
# print(perferD)
#3
perferD[time(3)] =getAQHI(3)
print(perferD)

