# NAMSAI api documentaion
version: 1


## GLOBAL ERROR message
ERROR:
  -
    response_code: 404
    code: 404
    message: invalid route
  -
    response_code: 500
    code: 500
    description: internal server error
  -
    response_code: 401
    code: 401
    message: access_token is invalid
  - response_code: 400
    code: 400
    message: access_token is require

## Authentication

### login
POST: /v1/auth
PARAMETER: email,password
RETURN: access_token,
ERROR:
  -
    response_code: 401
    code: 1
    message: username,email or password isn\'t correct
  -
    response_code: 400
    code: 2
    message: require parameter username or email and password

## User

## แสดงข้อมูลผู้ใช้ของฉัน
GET: /v1/users
PARAMETER:
  - access_token
RESPONSE:
  - id
  - public_repos (นับจำนวน repo ที่มี)

### แสดงข้อมูลของผู้ใช้คนที่กำหนด
GET: /v1/users/:username
PARAMETER:
RESPONSE:
  - id
  - public_repos (นับจำนวน repo ที่มี)
ERROR:
  -
    response_code: 404
    code: 3
    message: username {{:username}} not found,

### สมัครสมาชิกใหม่
POST: /v1/users
PARAMETER: email,username,password

## Repo

### ตอบโต้กับบอท
POST: /v1/repo/:name/talk
PARAMETER: message,id(Optional)

### เพิ่มโหนดใหม่
POST: /v1/repo/:name/node

### ลบโหลด
DELETE: /v1/repo/:name/node

### อัปเดตข้อมูลโหนด
PUT: /v1/repo/:name/node
