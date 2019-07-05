

CREATE TABLE TaiKhoan(
	id INT AUTO_INCREMENT,
	tendangnhap VARCHAR(16) NOT NULL,
	matkhau TEXT NOT NULL,
	tennguoidung TEXT NOT NULL,
	gioitinh INT NOT NULL, --0 là nữ, 1 là nam, 2 là khác
	socmnd VARCHAR(15) NOT NULL,
	sdt VARCHAR(15),
	quyen INT,
	PRIMARY KEY(id)
);


CREATE TABLE Ban(
	id INT AUTO_INCREMENT,
	sochongoi INT NOT NULL,
	loaiban INT NOT NULL,
	mota TEXT, 
	phuphi VARCHAR(20) DEFAULT 0,
	ghichu TEXT,
	trangthai INT,
	PRIMARY KEY(id)
);

CREATE TABLE ThucDon(
	id INT AUTO_INCREMENT NOT NULL,
	ten TEXT NOT NULL,
	giatien VARCHAR(20) DEFAULT 0,
	loai INT DEFAULT 0,
	anh TEXT,
	ghichu TEXT,
	PRIMARY KEY(id)
);

CREATE TABLE PhieuOrder(
	id INT AUTO_INCREMENT NOT NULL,
	idban INT,
	idnhanvien INT,
	thoigiantao DATETIME,
	PRIMARY KEY(id),
	FOREIGN KEY(idban) REFERENCES dbo.Ban(id),
	FOREIGN KEY(idnhanvien) REFERENCES dbo.TaiKhoan(id)
);


CREATE TABLE ChiTietPhieu(
	id INT AUTO_INCREMENT NOT NULL,
	idphieuorder INT,
	idmon INT,
	soluong INT DEFAULT 1,
	ghichu TEXT,
	trangthai INT DEFAULT 0,
	PRIMARY KEY(id),
	FOREIGN KEY(idphieuorder) REFERENCES dbo.PhieuOrder(id),
	FOREIGN KEY(idmon) REFERENCES dbo.ThucDon(id)
);

CREATE TABLE HoaDon(
	id INT AUTO_INCREMENT NOT NULL,
	idphieu INT,
	thoigiantao DATETIME DEFAULT GETDATE(),
    tongtien VARCHAR(20),
    trangthai INT DEFAULT 0,
	PRIMARY KEY(id),
	FOREIGN KEY(idphieu) REFERENCES dbo.PhieuOrder(id)
);



CREATE TABLE XuLySuCo(
	id INT AUTO_INCREMENT NOT NULL,
	idhoadon INT,
	mieuta TEXT,
	PRIMARY KEY(id),
	FOREIGN KEY(idhoadon) REFERENCES dbo.HoaDon(id)
);

CREATE TABLE DatBan(
	id INT AUTO_INCREMENT NOT NULL,
	idban INT,
	ngaydat DATE,
	giodat TIME,
	tenkhachhang TEXT,
	sdt TEXT,
	trangthai INT, --0: Chưa gọi xác nhận, 1 đã gọi
)