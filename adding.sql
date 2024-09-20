-- 3. Membuat Tabel `bus` (Informasi Bus)
CREATE TABLE IF NOT EXISTS bus (
    bus_id INT AUTO_INCREMENT PRIMARY KEY,
    bus_number VARCHAR(20) UNIQUE NOT NULL,
    route VARCHAR(100) NOT NULL,
    seat_capacity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Membuat Tabel `customer` (Informasi Pelanggan)
CREATE TABLE IF NOT EXISTS customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. Membuat Tabel `booking` (Pemesanan Tiket)
CREATE TABLE IF NOT EXISTS booking (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    bus_id INT,
    seat_number INT NOT NULL,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
    FOREIGN KEY (bus_id) REFERENCES bus(bus_id)
);

-- Membuat Tabel `bus`
CREATE TABLE IF NOT EXISTS bus (
    bus_id INT AUTO_INCREMENT PRIMARY KEY,
    bus_number VARCHAR(20) UNIQUE NOT NULL,
    route VARCHAR(100) NOT NULL,
    seat_capacity INT NOT NULL CHECK (seat_capacity IN (32, 48)), -- Seat capacity hanya 32 atau 48
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Data Dummy untuk Tabel `bus`
INSERT INTO bus (bus_number, route, seat_capacity) VALUES
('B1001', 'Jakarta - Bandung', 32),
('B1002', 'Bandung - Yogyakarta', 48),
('B1003', 'Yogyakarta - Surabaya', 32),
('B1004', 'Surabaya - Bali', 48),
('B1005', 'Bali - Jakarta', 32),
('B1006', 'Jakarta - Semarang', 48),
('B1007', 'Semarang - Surabaya', 32),
('B1008', 'Bandung - Medan', 48),
('B1009', 'Medan - Jakarta', 32),
('B1010', 'Jakarta - Malang', 48);

-- Data Dummy untuk Tabel `customer`
INSERT INTO customer (name, email, phone) VALUES
('Andika Rizky', 'andika.rizky@example.com', '08123456789'),
('Siti Nurhaliza', 'siti.nurhaliza@example.com', '08198765432'),
('Budi Santoso', 'budi.santoso@example.com', '08234567890'),
('Citra Melati', 'citra.melati@example.com', '08345678901'),
('Dimas Prabowo', 'dimas.prabowo@example.com', '08456789012'),
('Fajar Nanda', 'fajar.nanda@example.com', '08567890123'),
('Galih Anggara', 'galih.anggara@example.com', '08678901234'),
('Hendra Kurniawan', 'hendra.kurniawan@example.com', '08789012345'),
('Imam Fakhri', 'imam.fakhri@example.com', '08890123456'),
('Joko Widodo', 'joko.widodo@example.com', '08901234567');

-- Data Dummy untuk Tabel `booking`
INSERT INTO booking (customer_id, bus_id, seat_number) VALUES
(1, 1, 12),
(2, 1, 5),
(3, 2, 20),
(4, 2, 15),
(5, 3, 1),
(6, 3, 3),
(7, 4, 7),
(8, 4, 10),
(9, 5, 8),
(10, 5, 4),
(1, 6, 9),
(2, 6, 18),
(3, 7, 25),
(4, 7, 14),
(5, 8, 11),
(6, 8, 17),
(7, 9, 6),
(8, 9, 13),
(9, 10, 16),
(10, 10, 19),
(1, 1, 22),
(2, 2, 23),
(3, 2, 24),
(4, 3, 2),
(5, 3, 26),
(6, 4, 27),
(7, 4, 28),
(8, 5, 29),
(9, 5, 30),
(10, 6, 31),
(1, 6, 32),
(2, 7, 33),
(3, 7, 34),
(4, 8, 35),
(5, 8, 36),
(6, 9, 37),
(7, 9, 38),
(8, 10, 39),
(9, 10, 40),
(10, 1, 41),
(1, 2, 42),
(2, 3, 43),
(3, 4, 44),
(4, 5, 45),
(5, 6, 46),
(6, 7, 47),
(7, 8, 48);
