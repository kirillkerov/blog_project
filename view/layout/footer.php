    </div>
    <footer class="py-3 my-4 bg-light">
        <div class="container-fluid">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li><a href="/" class="nav-link px-2 link-secondary">Главная</a></li>
                <?php foreach ($pages = App\Models\Page::all() as $page): ?>
                    <li><a href="/page/<?= $page['name'] ?>" class="nav-link px-2 link-secondary"><?= $page['title'] ?></a></li>
                <?php endforeach ?>
            </ul>
            <p class="text-center text-muted">&copy; 2021 Company, Inc</p>
        </div>
    </footer>

</div>
<script src="/view/js/masonry.pkgd.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/view/js/bootstrap.min.js"></script>
<script src="/view/js/ajax.js"></script>
<script src="/view/js/myscript.js"></script>

</body>
</html>