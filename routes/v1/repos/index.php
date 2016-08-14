<?php
$app->group('/repos', function () use ($app,$config,$pdo) {
    require('management/repoAdd.php');
    require('management/repoGet.php');
    require('management/repoRemove.php');
    require('management/privateGet.php');
    require('management/privateSet.php');
    require('management/privateUnset.php');
    require('management/descriptionGet.php');
    require('management/descriptionUpdate.php');
});


/*
-----------------
ส่วนจัดการทั่วไป
-----------------



ดึงข้อมูลผู้ร่วมพัฒนาทั้งหมด
GET: /repos/:user/:repo/contributor
PARAMETER:
  - access_token (Optional for private repo only)
RESPONSE:
  - id (repo's id)
  - contributor (array){id,name,username}

เพิ่มผู้ร่วมพัฒนา
POST: /repos/:user/:repo/contributor
PARAMETER:
  - username
  - access_token (owner only)
RESPONSE:
  - id (repo's id)

ลบผู้ร่วมพัฒนา
DELETE: /repos/:user/:repo/contributor
PARAMETER:
  - username
  - access_token (owner only)
RESPONSE:
  - id (repo's id)

// Fork,merge,issue,wiki ไม่มาเร็วๆนี้แน่นอน


----------------------
ส่วนจัดการ NLP
- cilent_secret (ยังไม่รองรับเร็วๆนี้)
----------------------
สนทนากับบอท
POST: /repos/:user/:repo/response
PARAMETER:
  - id (interactive's id)
  - input
RESPONSE:
  - message

ดึงค่าตัวแปร
GET: /repos/:user/:repo/variable/:type/:varName
PARAMETER:
  - id (interactive's id - require for type session and user)
RESPONSE
  - id (variable's id)
  - value

กำหนดค่าตัวแปร
POST: /repos/:user/:repo/variable/:type/:varName
PARAMETER:
  - access_token (optional for variable type app only)
  - id (interactive's id - require for type session and user)
  - value
RESPONSE
  - id (variable's id)

ลบตัวแปร
DELETE: /repos/:user/:repo/variable/:type/:varName
PARAMETER:
  - access_token (optional for variable type app only)
  - id (interactive's id - require for type session and user)
RESPONSE
  - id (variable's id)


ดึงค่าของโหนด
GET: /repos/:user/:repo/node/:id
PARAMETER:
  - access_token (optional for private repo)
RESPONSE
  - type
  - value
  - story {id,name}

สร้างโหนดใหม่
POST: /repos/:user/:repo/node
PARAMETER:
  - access_token
  - story_id
  - value
RESPONSE:
  - id (node's id)

เปลี่ยนค่าโหนดเดิม
POST: /repos/:user/:repo/node/:id
PARAMETER:
  - access_token
  - value
RESPONSE:
  - id (node's id)

ลบโหนด
DELETE: /repos/:user/:repo/node/:id
PARAMETER:
  - access_token
RESPONSE:
  - id (node's id)

รับเส้นเชื่อม
GET: /repos/:user/:repo/edge/:id
PARAMETER:
  - access_token (optional for private repo)
RESPONSE:
  - id (Edge id)
  - current
  - next

สร้างเส้นเชื่อมใหม่ระหว่าง 2 Node
POST /repos/:user/:repo/edge/
PARAMETER:
  - access_token
  - current (current node id)
  - next (node that point next)
RESPONSE
  - id (edge's id)

ลบเส้นเชื่อม
DELETE: /repos/:user/:repo/edge/:id
PARAMETER:
  - access_token (optional for private repo)
RESPONSE:
  - id (Edge id)

ร้บหัวข้อเรื่อง
GET: /repos/:user/:repo/story/:id
PARAMETER:
  - access_token (optional for private repo)
RESPONSE:
  - name

สร้างหัวข้อเรื่องใหม่
POST: /repos/:user/:repo/story
PARAMETER:
  - name (optional)
  - access_token
RESPONSE:
  - id (story's id)

ลบหัวข้อเรื่อง
DELETE: /repos/:user/:repo/story/id
PARAMETER:
  - access_token
RESPONSE:
  - id (story's id)

  */
?>
