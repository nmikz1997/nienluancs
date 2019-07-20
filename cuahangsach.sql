CREATE DATABASE IF NOT EXISTS nienluancs CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci';

use nienluancs;


create table theloai(
	maloai char(10) primary key,
	tenloai varchar(50) not null
);

create table nhaxuatban(
	manxb char(10) primary key,
	tennxb varchar(50) not null
);


create table truyen(
	matruyen char(10) primary key,
	tentruyen varchar(50) not null,
	manxb char(10) not null,
	tacgia varchar(50) not null,
	ngayxb date not null,
	noidung text,
	FOREIGN KEY (manxb) REFERENCES nhaxuatban(manxb)
);


create table loai_truyen(
	matruyen char(10) not null,
	maloai char(10) not null,
	PRIMARY KEY (matruyen,maloai),
	FOREIGN KEY (matruyen) 	REFERENCES truyen(matruyen)
		on delete cascade
		on update cascade,
	FOREIGN KEY (maloai) 	REFERENCES theloai(maloai)
		on delete cascade
		on update cascade
);

create table tacgia(
	matg char(10) primary key,
	tentg varchar(50) not null,
	imgtg varchar(255),
	info text
);


create table tacgia_truyen(
	matg char(10) not null,
	matruyen char(10) not null,
	primary key(matg,matruyen),
	FOREIGN KEY (matruyen) 	REFERENCES truyen(matruyen)
		on delete cascade
		on update cascade,
	FOREIGN KEY (matg) 	REFERENCES tacgia(matg)
		on delete cascade
		on update cascade
);


create table khachhang(
	sdtkh char(12) primary key,
	tenkh varchar(50) not null,
	emailkh varchar(50) not null
);


create table user(
	user char(12) primary key,
	pass varchar(255) not null,
	quyen bool not null,
	FOREIGN KEY (user) 	REFERENCES khachhang(sdtkh)
);

insert into khachhang values('admin','Trịnh Thế Nguyễn', 'trinhthenguyen123@gmail.com');
insert into khachhang values('user','A A A', 'aaa@gmail.com');

insert into user values('admin',md5(123123),1);
insert into user values('user',md5(123123),0);

select * from user;

delete from khachhang where sdtkh='0946730447';

select * from khachhang;

insert into admin values ('admin',md5('123456'));

create table hoadon(
	mahd int(10) primary key AUTO_INCREMENT,
	sdtkh char(12) not null,
	diachi varchar(255) not null,
	tonggt int not null,
	ngaylap date not null,
	giaohang bool not null DEFAULT 0,
	FOREIGN KEY (sdtkh) REFERENCES khachhang(sdtkh)
);

select * from hoadon;
insert into hoadon (sdtkh,diachi,tonggt,ngaylap) values("0946730447","diachi","111111",curdate());

select * from cthoadon;

create table chitiettruyen(
	matruyen char(10) not null,
	tinhtrang char(6) not null,
	ngaynhap date not null,
	bia varchar(255) not null,
	gia double not null,
	soluong int(10) not null,
	FOREIGN KEY (matruyen) 	REFERENCES truyen(matruyen)
		on delete cascade
		on update cascade,
	primary key (matruyen,tinhtrang)
);


create table cthoadon(
	mahd int(10) not null,
	matruyen char(10) not null,
	tinhtrang char(6) not null,
	soluong int(10) not null,
	FOREIGN KEY (mahd) REFERENCES hoadon(mahd)
		on delete cascade,
	FOREIGN KEY (matruyen,tinhtrang) REFERENCES chitiettruyen(matruyen,tinhtrang),
	PRIMARY KEY (mahd,matruyen,tinhtrang)
);

select * from hoadon;
select * from cthoadon;


insert into nhaxuatban values("KD","NXB Kim Đồng");
insert into nhaxuatban values("TRE","NXB Trẻ");
insert into nhaxuatban values("TAB","T.A Books");
insert into nhaxuatban values("DT","Đinh Tị");
insert into nhaxuatban values("TV","Trí Việt");

insert into theloai values("action","Hành Động");
insert into theloai values("advent","Phiêu lưu");
insert into theloai values("comedy","Hài hước");
insert into theloai values("cooking","Ẩm Thực");
insert into theloai values("fantasy","Kỳ ảo");
insert into theloai values("mecha","Mecha");
insert into theloai values("VT","Võ thuật");
insert into theloai values("psy","Tâm lí học");
insert into theloai values("scifi","khoa học viễn tưởng");
insert into theloai values("VN","Việt Nam");
insert into theloai values("detective","Trinh Thám");


SELECT * from chitiettruyen where matruyen='111' and tinhtrang='old';

UPDATE hoadon
	set giaohang=1
	where mahd=1;

UPDATE chitiettruyen
	set
		soluong=2222
	where
		matruyen='111' and
		tinhtrang='old';
								
SELECT soluong from chitiettruyen where soluong > 8 and matruyen = '1' and tinhtrang ='new';
SELECT * from hoadon;

select * from chitiettruyen;

UPDATE chitiettruyen
	set
		soluong=soluong - 1
	where
		matruyen  ='1' and
		tinhtrang ='new';

select * from khachhang;

select * from chitiettruyen;
SELECT gia from chitiettruyen where matruyen = '1' and tinhtrang = 'new';

SELECT matruyen,tinhtrang from chitiettruyen;

