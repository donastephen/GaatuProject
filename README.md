Product_ProductList
=============

### Description

Project for storing a list of products when the user scans a SKU, a unique 6 digit integer that represents a Product. 
This app allows to add new Product and ProductList. Screenshots are in web/screenshots folder.

### Symfony components used
Doctrine for ORM
Twig for frontend
Composer


### Database tables
Product 
ProductList
Product_ProductList


### Code
App is in src/ProductBundle.
Added many-to-many mapping in Product and ProductList table. That automatically generates mapping table.
Created two new FormTypes (ProductBundle/Form/Type/ProductType & ProductBundle/Form/Type/ProductListType) to 
use many-to-many mapping in Twig Forms.
Created base twig file so that other product file can inherit its layout, style and javascript.


### Assumptions
Sku already exists in Product table when user try to add it to Product List.


### Note
Product_list form currently only takes one sku. Backend code is written to handle multiple skus.
Tried to implement ProductList form that can dynamically add Products but need more time for end to end testing.


