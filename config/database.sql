-- Use the testing database
USE testing;

-- Create tables

-- Table users
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255),
    password VARCHAR(255),
    first_name VARCHAR(255),
    family_name VARCHAR(255),
    email_address VARCHAR(255),
    contact_number VARCHAR(255),
    user_type ENUM('Admin', 'Doctor', 'Nurse', 'Patient')
);

-- Table rooms
CREATE TABLE rooms (
    room_number INT PRIMARY KEY AUTO_INCREMENT,
    room_status ENUM('Occupied', 'Not_occupied', 'Office'),
    price_per_night INT
);

-- Table doctors
CREATE TABLE doctors (
    doctor_id INT PRIMARY KEY,
    doctor_specialty ENUM('Generalist', 'Pediatrist', 'Cardiologist', 'Ophthalmologist', 'Genycologist'),
    schedule VARCHAR(255),
    office INT,
    FOREIGN KEY (office) REFERENCES rooms(room_number),
    FOREIGN KEY (doctor_id) REFERENCES users(user_id)
);

-- Table patients
CREATE TABLE patients (
    patient_id INT PRIMARY KEY,
    date_of_birth DATE,
    medical_record VARCHAR(255),
    emergency_contact_number VARCHAR(255),
    patient_type ENUM('inpatient'),
    host_room INT,
    nights_stayed INT,
    diet_type ENUM('Normal', 'No_salt', 'No_sugar'),
    FOREIGN KEY (host_room) REFERENCES rooms(room_number),
    FOREIGN KEY (patient_id) REFERENCES users(user_id)
);

-- Table nurses
CREATE TABLE nurses (
    nurse_id INT PRIMARY KEY,
    shift ENUM('Day', 'Night'),
    care_id INT,
    FOREIGN KEY (nurse_id) REFERENCES users(user_id),
    UNIQUE (nurse_id, care_id)
);

-- Table medical_care
CREATE TABLE medical_care (
    care_id INT PRIMARY KEY,
    patient_id INT,
    med_id INT,
    dosage INT,
    frequency INT,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);

-- Table medicines
CREATE TABLE medicines (
    med_id INT PRIMARY KEY,
    med_name VARCHAR(255),
    med_quantity INT,
    purchase_price INT,
    selling_price INT,
    purchase_history VARCHAR(255)
);

-- Table equipment
CREATE TABLE equipment (
    eq_id INT PRIMARY KEY,
    eq_name VARCHAR(255),
    eq_quantity INT,
    purchase_price INT,
    purchase_history VARCHAR(255)
);

-- Table consultations
CREATE TABLE consultations (
    consultation_id INT PRIMARY KEY,
    doctor_id INT,
    consultation_room INT,
    patient_id INT,
    consultation_date DATE,
    consultation_time TIME,
    consultation_price INT,
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id),
    FOREIGN KEY (consultation_room) REFERENCES doctors(office),
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);

-- Table surgeries
CREATE TABLE surgeries (
    surgery_id INT PRIMARY KEY,
    doctor_id INT,
    patient_id INT,
    surgery_room INT,
    surgery_date DATETIME,
    surgery_price INT,
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id),
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
    FOREIGN KEY (surgery_room) REFERENCES rooms(room_number)
);

-- Table feedbacks
CREATE TABLE feedbacks (
    feedback_id INT PRIMARY KEY,
    user_id INT,
    description VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Table billing
CREATE TABLE billing (
    bill_id INT PRIMARY KEY,
    patient_id INT,
    patient_type ENUM('inpatient', 'outpatient'),
    consultation_price INT,
    surgery_price INT,
    total_night_price INT,
    medication_cost INT,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);
