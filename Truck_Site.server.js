// TRUCK_SITE.server.js — ESM
import express from 'express';
import cors from 'cors';
import dotenv from 'dotenv';
dotenv.config({ path: './Truck_Site.env' });
console.log('[ENV] loaded from Truck_Site.env');
import fs from "fs";
import path from "path";
import sgMail from "@sendgrid/mail";
const SG_KEY = process.env.SENDGRID_API_KEY || '';
if (SG_KEY.startsWith('SG.')) {
  sgMail.setApiKey(SG_KEY);
  console.log('[SG] ready');
} else {
  console.log('[SG] missing SENDGRID_API_KEY — test mode only');
}
import { fileURLToPath } from "url";

console.log('[ENV] loaded from Truck_Site.env');

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const MAIL_FROM    = process.env.MAIL_FROM;
const MAIL_TO      = process.env.MAIL_TO || MAIL_FROM;
const MAIL_SUBJECT = process.env.MAIL_SUBJECT || "New Truck Repair Request";

// App
const app = express();
app.use(cors());
app.use(express.json({ limit: "100kb" }));
app.use(express.urlencoded({ extended: false }));

// статика
app.use(express.static(path.join(__dirname, "public")));

// health
app.get("/_ping", (req, res) => res.type("text").send("pong"));

// корень → index.html
app.get("/", (req, res) => {
  res.sendFile(path.join(__dirname, "public", "index.html"));
});

// /form → form.html (если файла нет — 404)
app.get("/form", (req, res) => {
  const f = path.join(__dirname, "public", "form.html");
  return fs.existsSync(f)
    ? res.sendFile(f)
    : res.status(404).type("text").send("form.html not found");
});

// приём формы
app.post("/api/repair-request", async (req, res) => {
  try {
    const { address, description, breakdown, email, phone } = req.body;
    const issue = (description ?? breakdown ?? "").trim();

    const ok =
      typeof address === "string" && address.trim() &&
      typeof issue === "string" && issue &&
      typeof email === "string" && email.trim() &&
      String(phone ?? "").trim();

    if (!ok) return res.status(400).json({ ok: false, error: "Missing fields" });

    const submittedAt = new Date().toISOString();
    fs.appendFile("./submissions.log",
      JSON.stringify({
        submittedAt,
        address: address.trim(),
        description: issue,
        email: email.trim(),
        phone: String(phone).trim()
      }) + "\n",
      (err) => err && console.error("[FILE LOG ERROR]", err)
    );
// === Test mode if email creds are missing ===
if (!process.env.SENDGRID_API_KEY || !process.env.MAIL_FROM) {
  console.log("[TEST MODE] Missing SENDGRID config -> skipping email. Body:", req.body);
  return res.status(200).json({ ok: true, message: "Form received (test mode)." });
}
// === end test mode ===
    if (process.env.SENDGRID_API_KEY?.startsWith("SG.") && MAIL_FROM) {
      try {
        const [resp] = await sgMail.send({
          to: MAIL_TO,
          from: MAIL_FROM,
          subject: MAIL_SUBJECT,
          text:
`Address: ${address}
Issue: ${issue}
Email: ${email}
Phone: ${phone}
Submitted: ${submittedAt}`
        });
        console.log("[SG OK] sent, id:", resp?.headers?.["x-message-id"]);
      } catch (e) {
        console.error("[SG ERROR]", e?.response?.body || e.message || e);
      }
    } else {
      console.warn("[SG SKIP] missing SENDGRID_API_KEY or MAIL_FROM");
    }

    return res.json({ ok: true });
  } catch (e) {
    console.error(e);
    return res.status(500).json({ ok: false, error: "Server error" });
  }
});

const PORT = Number(process.env.PORT) || 3333;
const PUBLIC_HOST = process.env.PUBLIC_HOST || "165.232.139.129";
app.listen(PORT, "0.0.0.0", () => {
  console.log(`Server running on port ${PORT}`);
  console.log(`Local (SSH):  http://127.0.0.1:${PORT}`);
  console.log(`Public (Mac): http://${PUBLIC_HOST}:${PORT}`);
});
