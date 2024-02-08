import cgi, cgitb

print("Hello world! Python works!")

import sys


sys.path.append('/Library/Frameworks/Python.framework/Versions/3.11/lib/python3.11/site-packages/')


print(sys.path)

import redis


cl0 = redis.StrictRedis(db=0, charset="utf-8", decode_responses=True)
print(cl0)

if __name__ == '__main__':
    print('Hello, World!')