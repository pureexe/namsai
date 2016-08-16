# NAMSAI api documentaion
version: 1

//TODO: Need to implement
- check token date issue and make blacklist after change password

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

### สมัครสมาชิกใหม่
POST: /v1/users
PARAMETER: email,username,password,name
RETURN: (user) id
ERROR:
  -
    response_code: 400
    code: 4
    message: parameter name,email,username and password is require for register
  -
    response_code: 400
    code: 5
    message: this email has been already register
  -
    response_code: 400
    code: 6
    message: this username has been already register
  -
    response_code: 400
    code: 7
    message: username {{username}} is reserved for system

### เปลี่ยนพาสเวิร์ด
POST: /v1/users/password
PARAMETER: password,newpassword,access_token
RESPONSE: (user)id
ERROR:
  -
    response_code: 400
    code: 8
    message: password is mismatch

### เปลี่ยนอีเมล
POST: /v1/users/email
PARAMETER: email,access_token
RESPONSE: (user)id
ERROR:
  -
    response_code: 400
    code: 5
    message: this email has been already register
  -
    response_code: 400
    code: 9
    message: email is invalid


### เปลี่ยนชื่อเต็ม
POST: /v1/users/name
PARAMETER: name,access_token
RESPONSE: (user)id
ERROR:

### เปลี่ยนคำอธิบาย
POST: /v1/users/bio
PARAMETER: bio

### แสดงข้อมูลผู้ใช้ของฉัน
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
  - name
  - username
  - email
  - bio
  - public_repos (นับจำนวน repo ที่มี)
ERROR:
  -
    response_code: 404
    code: 3
    message: username {{:username}} not exist,

### แสดง repos ของผู้ใช้ที่กำหนด
GET: /v1/users/:username/repos


## Repo

### สร้าง REPO ใหม่
POST: /v1/repos/:user/:repo/
PARAMETER:
  - access_token
  - name
  - description
  - private (boolean)
RESPONSE:
  - id (repo's id)
ERROR:
  -
    response_code: 400
    code: 10
    message: require parameter access_token,name and description
  -
    response_code: 400
    code: 11
    message: name must contain english alphabelt and number only
  -
    response_code: 400
    code: 12
    message: respository name {{name}} isn't avaliable

### เข้าถึง REPO
GET: /v1/repos/:user/:repo/
PARAMETER:
  - access_token (Optional for private repo only)
RESPONSE:
  - id (repo's id)
  - name
  - description
  - private (boolean)
ERROR:
  -
    response_code: 404
    code: 13
    message: respository {{user}}/{{name}} isn't found

### ลบ REPO
DELETE: /v1/repos/:user/:repo/
PARAMETER:
  - access_token
RESPONSE:
  - id (repo's id)
ERROR:
  -
    response_code: 401
    code: 14
    message: only owner can delete repository

### อ่านค่า private ของ repo
ดูว่า repo ปัจจุบันเป็น Private อยู่หรือไม่
GET: /repos/:user/:repo/private
PARAMETER:
  - access_token (Optional for private repo only)
RESPONSE:
  - id (repo's id)
  - private (boolean)

### ตั้ง Private ของ repo
POST: /repos/:user/:repo/private
PARAMETER:
  - access_token
RESPONSE:
  - id (repo's id)
Error
  -
    response_code: 401
    code: 15
    message: only owner can set private state

### อ่านรายละเอียดของ repo
GET: /repos/:user/:repo/description
PARAMETER:
  - access_token (Optional for private repo only)
RESPONSE:
  - id (repo's id)
  - description

### เปลี่ยนรายละเอียดของ repo
POST: /repos/:user/:repo/description
PARAMETER:
  - access_token
  - description
RESPONSE:
  - id (repo's id)
ERROR:
  -
    response_code: 401
    code: 15
    message: only owner can set description
  -
    response_code: 400
    code: 16
    message: require parameter access_token and description

#เพิ่มผู้ร่วมพัฒนา
POST: /repos/:user/:repo/contributor
PARAMETER:
  - username
  - access_token (owner only)
RESPONSE:
  - id (repo's id)
ERROR:
  -
    response_code: 400
    code: 17
    message: require parameter access_token and username
  -
    response_code: 401
    code: 18
    message: only owner can add contributor
  -
    response_code: 400
    code: 19
    message: {{user}} has been already add to {{username}}/{{reponame}}

##ดึงข้อมูลผู้ร่วมพัฒนาทั้งหมด
GET: /repos/:user/:repo/contributor
PARAMETER:
  - access_token (Optional for private repo only)
RESPONSE:
  - id (repo's id)
  - contributor (array){id,username,name,email,bio}
