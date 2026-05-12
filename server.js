const express = require('express');
const path = require('path');
const webRoutes = require('./src/routes/web');

const app = express();
const port = process.env.PORT || 3000;

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'src', 'views'));

app.use(express.static(path.join(__dirname, 'public')));
app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use('/', webRoutes);

app.listen(port, () => {
  console.log(`LuxeCurtain Hub running on http://localhost:${port}`);
});
