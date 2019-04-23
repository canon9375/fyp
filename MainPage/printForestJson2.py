from pymongo import MongoClient
import datetime
from datetime  import date, timedelta
import json
from dateutil.parser import parse
from sklearn.neural_network import MLPClassifier
import numpy as np

def getLanLongText(location):
    location = location.replace(' ','').casefold()
    locaList=[['causewaybay',22.2801379,114.1829043],['central',22.2818189,114.1559413]
                , ['central/western',22.317831,114.194941], ['eastern',22.2477915,114.1496074]
                ,['kwaichung',22.3283503,114.0142057],['kwuntong',22.3133199,114.2226423]
                ,['mongkok',22.3226159,114.1660853],['shamshuipo',22.3302309,114.1569233]
                ,['shatin',22.3762849,114.1823453],['',9],['taipo',22.4509649,114.1623843]
                ,['tapmun',22.4713209,114.3585323],['tseungkwano',22.3261644,114.1147959]
                ,['tsuenwan',22.3260131,114.114796],['tuenmun',22.4181877,113.9821814]
                ,['tungchung',22.2888939,113.9414723],['yuenlong',22.4451599,114.0204623]]
    for record in locaList:
        if record[0]==location:
            return {"lantitude": record[1],"longtitude":record[2]}
    return None
def getLanLongNum(location):
    location = location.replace(' ','').casefold()
    locaList=[['causewaybay',22.2801379,114.1829043],['central',22.2818189,114.1559413]
                , ['central/western',22.317831,114.194941], ['eastern',22.2477915,114.1496074]
                ,['kwaichung',22.3283503,114.0142057],['kwuntong',22.3133199,114.2226423]
                ,['mongkok',22.3226159,114.1660853],['shamshuipo',22.3302309,114.1569233]
                ,['shatin',22.3762849,114.1823453],['',9],['taipo',22.4509649,114.1623843]
                ,['tapmun',22.4713209,114.3585323],['tseungkwano',22.3261644,114.1147959]
                ,['tsuenwan',22.3260131,114.114796],['tuenmun',22.4181877,113.9821814]
                ,['tungchung',22.2888939,113.9414723],['yuenlong',22.4451599,114.0204623]]
    for record in locaList:
        if record[0]==location:
            return [record[1],record[2]]
    return None
def genPredict2(result):
    if(result.count()>0):
        inputData =[]
        outputData =[]
        reData =[]
        for i in result:
            t =(getLanLongNum(i['location']))
            inputData.append(getLanLongNum(i['location']))
            if int(i['aqhi']):
                outputData.append([int(i['aqhi'])])
                aqhi = int(i['aqhi'])
                t.append(i['aqhi'])
                t.append(1)
            else:
                outputData.append([3])
                t.append(3)
                t.append(1)
            reData.append(t)
        ANNmodel = MLPClassifier(
                    activation='relu',   #激活函数为relu,类似于s型函数
                   hidden_layer_sizes=200)  #隐藏层为i
        ANNmodel.fit(inputData,outputData)  #训练模型
        with open('500LanLong.json', 'r') as outfile:  
            LanLo100= json.load(outfile)
        pInput = []
        for i in LanLo100:
            pInput.append(i['center']) 
        annAqhi = ANNmodel.predict(pInput)
        for i in range (len(LanLo100)):
            LanLo100[i]['center'].append(str(annAqhi[i]))
            LanLo100[i]['center'].append(2)
            reData.append(LanLo100[i]['center'])
        return reData
# Has data in database
def genPredict(result):
    if(result.count()>0):
        inputData =[]
        outputData =[]
        reData =[]
        for i in result:
            t =(getLanLongNum(i['location']))
            inputData.append(getLanLongNum(i['location']))
            if int(i['paqhi']):
                outputData.append([int(i['paqhi'])])
                aqhi = int(i['paqhi'])
                t.append(i['paqhi'])
                t.append(1)
            else:
                outputData.append([3])
                t.append(3)
                t.append(1)
            reData.append(t)
        ANNmodel = MLPClassifier(
                    activation='relu',   #激活函数为relu,类似于s型函数
                   hidden_layer_sizes=200)  #隐藏层为i
        ANNmodel.fit(inputData,outputData)  #训练模型
        with open('500LanLong.json', 'r') as outfile:  
            LanLo100= json.load(outfile)
        pInput = []
        for i in LanLo100:
            pInput.append(i['center']) 
        annAqhi = ANNmodel.predict(pInput)
        for i in range (len(LanLo100)):
            LanLo100[i]['center'].append(str(annAqhi[i]))
            LanLo100[i]['center'].append(2)
            reData.append(LanLo100[i]['center'])
        return reData
conn=MongoClient('mongodb://admin:admin@cluster0-shard-00-00-9eks9.mongodb.net:27017,cluster0-shard-00-01-9eks9.mongodb.net:27017,cluster0-shard-00-02-9eks9.mongodb.net:27017/test?ssl=true&replicaSet=Cluster0-shard-0&authSource=admin&retryWrites=true')
coll3 = conn.fyp.predictData
col = conn.fyp.currentAQHI
perferD={}
# now
t =  datetime.datetime.now() 
fmt = t.strftime('%Y-%m-%d %H')
time = parse(fmt)- timedelta(hours=0.5)
ch =int(t.strftime('%M'))
if ch > 35:
    time = parse(fmt)+ timedelta(hours=0.5)
query = {'time':{"$eq":time}}
result = col.find(query) 
perferD[fmt]=[]
if not result.count()>0:
    query = {'dateTime':{"$eq":parse("2019-04-17 04")}}
    result = coll3.find(query) 
perferD[fmt] =genPredict2(result)
# 1
t =  datetime.datetime.now() + timedelta(hours=1)
fmt = t.strftime('%Y-%m-%d %H')
time = parse(fmt)
query = {'dateTime':{"$eq":time}}
result = coll3.find(query) 
perferD[fmt]=[]
if not result.count()>0:
    query = {'dateTime':{"$eq":parse("2019-04-17 05")}}
    result = coll3.find(query) 
perferD[fmt] =genPredict(result)
# 2
t =  datetime.datetime.now() + timedelta(hours=2)
fmt = t.strftime('%Y-%m-%d %H')
time = parse(fmt)
query = {'dateTime':{"$eq":time}}
result = coll3.find(query) 
perferD[fmt]=[]
if not result.count()>0:
    query = {'dateTime':{"$eq":parse("2019-04-17 06")}}
    result = coll3.find(query) 
perferD[fmt] =genPredict(result)
# 3
t =  datetime.datetime.now() + timedelta(hours=3)
fmt = t.strftime('%Y-%m-%d %H')
time = parse(fmt)
query = {'dateTime':{"$eq":time}}
result = coll3.find(query) 
perferD[fmt]=[]
if not result.count()>0:
    query = {'dateTime':{"$eq":parse("2019-04-17 04")}}
    result = coll3.find(query) 
perferD[fmt] =genPredict(result)
print(perferD)

    