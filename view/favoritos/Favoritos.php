

<?php if (empty($favoritos)) : ?>
    <p>No tienes mangas en favoritos todavía.</p>
<?php else : ?>
    <div class="Grid">
        <div class="Busqueda">
            <input type="search" id="buscarTitulo" placeholder="Busca tu manga favorito" onchange="redirigirBusqueda()">
        </div>
            
            <div class="Catalogo">
                <?php foreach ($favoritos as $manga): ?>
                <div class="Popular">
                    <a href="index.php?controller=kiwi&action=detalles&id=<?= htmlspecialchars($manga['manga_id']) ?>">
                        <img src="<?= htmlspecialchars($manga['imagen']) ?>" alt="<?= htmlspecialchars($manga['titulo']) ?>" />
                        <p title="<?= htmlspecialchars($manga['titulo']) ?>">
                            <?= strlen($manga['titulo']) > 100 
                                ? htmlspecialchars(substr($manga['titulo'], 0, 100)) . "..."
                                : htmlspecialchars($manga['titulo']) ?>
                        </p>
                    </a>

                    <div class="Favorito" data-id="<?= htmlspecialchars($manga['manga_id']) ?>" data-titulo="<?= htmlspecialchars($manga['titulo']) ?>" data-imagen="<?= htmlspecialchars($manga['imagen']) ?>">
                        <i class="fas fa-heart" style="font-size: 24px; color: red;"></i>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
    </div>
<?php endif; ?>