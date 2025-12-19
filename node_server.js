const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");
const mysql = require("mysql2/promise");

const app = express();
app.use(cors());
app.use(bodyParser.json());

const pool = mysql.createPool({
  host: "localhost",
  user: "root",
  password: "",
  database: "klinik_sekolah"
});

app.get("/api/students", async (req, res) => {
  try {
    const [rows] = await pool.query("SELECT * FROM students ORDER BY id DESC");
    res.json(rows);
  } catch (e) {
    res.status(500).json({ error: "error" });
  }
});

app.post("/api/students", async (req, res) => {
  const { name, address, age, complaint } = req.body;
  if (!name || !address || !complaint || !age) {
    return res.status(400).json({ error: "invalid" });
  }
  try {
    const date = new Date().toISOString().slice(0, 10);
    const status = "Belum diperiksa";
    await pool.query(
      "INSERT INTO students (name,address,age,complaint,visit_date,status) VALUES (?,?,?,?,?,?)",
      [name, address, age, complaint, date, status]
    );
    res.json({ success: true });
  } catch (e) {
    res.status(500).json({ error: "error" });
  }
});

app.post("/api/reports", async (req, res) => {
  const { student_id, content } = req.body;
  if (!content) {
    return res.status(400).json({ error: "invalid" });
  }
  try {
    if (student_id) {
      await pool.query("INSERT INTO reports (student_id,content) VALUES (?,?)", [
        student_id,
        content
      ]);
    } else {
      await pool.query("INSERT INTO reports (content) VALUES (?)", [content]);
    }
    res.json({ success: true });
  } catch (e) {
    res.status(500).json({ error: "error" });
  }
});

app.get("/api/history", async (req, res) => {
  try {
    const [rows] = await pool.query(
      "SELECT * FROM students WHERE status <> 'Belum diperiksa' ORDER BY id DESC"
    );
    res.json(rows);
  } catch (e) {
    res.status(500).json({ error: "error" });
  }
});

app.listen(3000, () => {});
