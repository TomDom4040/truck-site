// mini.js — минимальный сервер для диагностики
import express from 'express';

const app = express();

app.get('/_ping', (req, res) => {
  return res.type('text').send('pong');
});

app.get('/', (req, res) => {
  return res.type('text').send('OK');
});

const PORT = 3333;
app.listen(PORT, '0.0.0.0', () => {
  console.log(`MINI listening on http://0.0.0.0:${PORT}`);
});