const functions = require("firebase-functions");
const express = require("express");
const cors = require("cors");

const app = express();
app.use(cors({ origin: true }));
app.use(express.json());

// contoh categories
app.get("/categories", (req, res) => {
  res.json({
    data: [
      { id: 1, name: "Kategori 1", subcategories: [
        { id: 11, name: "Sub 1", children: [{ id: 111, name: "Sub-sub 1" }] }
      ]},
      { id: 2, name: "Kategori 2", subcategories: [] }
    ]
  });
});

// contoh products
app.get("/products", (req, res) => {
  const categoryId = req.query.category_id;
  const subcategoryId = req.query.subcategory_id;

  const allProducts = [
    { id: 1, name: "Produk A", price: 10000, category_id: 1, subcategory_id: 11 },
    { id: 2, name: "Produk B", price: 20000, category_id: 1, subcategory_id: 111 },
    { id: 3, name: "Produk C", price: 15000, category_id: 2 }
  ];

  let filtered = allProducts;
  if (subcategoryId) filtered = allProducts.filter(p => p.subcategory_id == subcategoryId);
  else if (categoryId) filtered = allProducts.filter(p => p.category_id == categoryId);

  res.json({ data: filtered });
});

exports.api = functions.https.onRequest(app);
