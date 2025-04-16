
<section class="categories">
    <h2>Danh mục</h2>
    <ul class="category-list">
        <li>
            <a href="#">
                <img src="assets/img/váy/anh11.jpg" alt="Váy" />
               
            </a>
        </li>
        <li>
            <a href="#">
                <img src="assets/img/áo phong/z6427049469666_5642f2b40d4f30e919ae96313d6b646b.jpg" alt="Áo Phông" />
              
            </a>
        </li>
        <li>
            <a href="#">
                <img src="assets/img/quần/z6427058916226_812197864e55a002aa64164fa47ce000.jpg" alt="Quần" />
                
            </a>
        </li>
        <li>
            <a href="#">
                <img src="assets/img/ao khoac/z6427065417228_c4d35643131b5ce9de14e98e3e4b8886.jpg" alt="Áo Khoác" />
                
            </a>
        </li>
    </ul>
</section>
<section class="featured-products">
    <h2>Sản Phẩm Nổi Bật</h2>
    <div class="product-grid">
        <!-- Sản phẩm 1 -->
         <?php foreach($listProduct as $product): ?>
        <div class="product-card">
            <div class="product-image">
                <img src="assets/img/<?php echo $product['image_url'];?>" alt="<?php echo $product['name'];?>"/>
                <div class="product-overlay">
                    <a href="product_detail.php?id=<?php echo $product['id'];?>" class="icon eye-icon"><i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="add_to_cart.php?product_id=<?php echo $product['id'];?>&quantity=1" class="icon cart-icon">🛒</a>
                </div>
            </div>
            <h3><?php echo $product['name']?></h3>
            <p>
                <?php if (!empty($product['old_price'])):?>
                    <span class="ole-price"><?php echo number_format($product['old_price'],0,',', '.');?>đ</span>
                    <?php endif; ?>
                </p>
            
        </div>
        <?php endforeach; ?>
    </div>
</section>

        