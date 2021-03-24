CREATE DATABASE db_notes;
USE db_notes;

CREATE TABLE tbl_notes (
    id_notes INT(11) PRIMARY KEY AUTO_INCREMENT,
    titleof_notes TEXT,
    contentof_notes TEXT,
    date_created TIMESTAMP,
    id_user INT(11),
    categoryof_notes TEXT
);
CREATE TABLE tbl_user (
    id_user INT(11) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR (40),
    password VARCHAR (40),
    hash_useracces TEXT,
    level VARCHAR (40),
    datauser_create TIMESTAMP 

);

INSERT INTO tbl_notes
(titleof_notes, contentof_notes, id_user, categoryof_notes)
VALUES
('mengerjakan tugas', 'kerjakan tugas RPL besok dikumpulkan', '1', 'ToDo'),
('Goes To Bali', 'ke bali bulan depan, harus ada persiapan! persiapan mental,jasmani dan persiapan dompet', '2', 'ToDo'),
('rapat Google meet', 'meeting online 12.00 a.m', '3', 'ToDo'),
('bantuin orang tua', 'bantuin orang tua beresin rumah', '4', 'ToDo'),
('Goal/Tujuan', 'mendapatkan nilai bagus setiap semester biar gampang masuk universitas', '5', 'ToDo'),
('Kata Mutiara', 'Sebaik-baik Peninggalan ialah ilmu bukan harta', '1', 'Notes'),
('Uang Jajan Bulanan', 'jangan boros! sebulan cuma sekali, kalo habis pas tengah bulan bisa gawat', '2', 'Notes'),
('Memo', 'Tanggal Rilis anime Demons Slayer Mugen Train 10 januari', '3', 'Notes'),
('Motivasi', 'Tidak ada sejarahnya orang mendapat kesuksesan dengan kemalasan', '4', 'Notes'),
('Apa itu buku? ', 'di katakan bahwa ilmu itu seperti hewan peliharaan yang harus kita ikat dengan catatan', '5', 'Notes'),
('SPP bulanan', 'Ketuntasan pembayaran SPP bulan januari', '1', 'Task'),
('Tugas RPL', 'Ketuntasan Tugas RPL tanggal 11 januari', '2', 'Task'),
('nilai semester 1', 'menuntaskan tujuan mendapatkan nilai memuaskan', '3', 'Task'),
('Murajaah surat al-mulk', 'murajaah tahfidz surat al-mulk', '4', 'Task'),
('Rangkuman Bahasa Indonesia', 'tuntas merangkum bahasa indonesia', '5', 'Task');

INSERT INTO tbl_user
(username, password, hash_useracces, level )
VALUES
( 'hanwonee', MD5 ('hanwonee!!&'), SHA1 ('admin'), 'administrator'),
( 'shina mashiro', MD5 ('!!&mashirona'), SHA1 ('admin'), 'staff'),
( 'sakurai yuta', MD5 ('sakuyuta!!&'), SHA1 ('admin'), 'staff'),
( 'yuzaki tsukasa', MD5 ('zakasa!!&'), SHA1 ('admin'), 'staff'),
( 'kamado nezuka', MD5 ('nezudo!!&'), SHA1 ('admin'), 'staff');

ALTER TABLE tbl_notes
ADD CONSTRAINT fknotes2user
FOREIGN KEY (id_user) REFERENCES tbl_user(id_user);

DESC tbl_notes;
DESC tbl_user;
SELECT * FROM tbl_notes;
SELECT * FROM tbl_user;

