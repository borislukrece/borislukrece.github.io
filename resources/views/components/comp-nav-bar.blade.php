<div style="
    width: 100%;
    height: 8%;
    display: flex;
    align-items: center;
    background: white;
    border-bottom: solid 2px #EC9628;
">
    <div style="
        display: flex;
        align-items: center;
        padding-left: 1rem;
        font-weight: bold;
    ">
        <a href="/menu/profil" style="
            margin-left: 1rem;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            <?php
            $route = Route::current()->uri;
            if ($route === 'menu/profil') {
            ?>
            border-bottom: solid 3px black;
            margin-bottom: 8px;
            <?php
                }
            ?>
        ">MON PROFIL</a>
        <a href="/menu/modifier-profil" style="
            margin-left: 1rem;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            <?php
            $route = Route::current()->uri;
            if ($route === 'menu/modifier-profil') {
            ?>
            border-bottom: solid 3px black;
            margin-bottom: 8px;
            <?php
                }
            ?>
        ">MODIFIER MON PROFIL</a>
    </div>
</div>