<div style="
    width:5%;
    height: 100%;
    background: rgba(255, 255, 255, 0.4);
    box-shadow: 0 4px 2px 3px rgba(0, 0, 0, 0.26);
    /* border-left: solid 1px #EC9628; */
">
    <div style="
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    ">
        <a href="/liste-agents" style="
            width: 2.5rem;
            height: 2.5rem;
            color: white;
            background:#D4D3DC;
            border-radius: 100%;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            <?php
            $route = Route::current()->uri;
            if ($route === 'liste-agents') {
            ?>
            color: #EC9628;
            <?php
                }
            ?>
        ">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
            </svg>
        </a>

        <a href="/ajouter-agent" style="
            width: 2.5rem;
            height: 2.5rem;
            color: white;
            background:#D4D3DC;
            border-radius: 100%;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            <?php
            $route = Route::current()->uri;
            if ($route === 'ajouter-agent') {
            ?>
            color: #EC9628;
            <?php
                }
            ?>
        ">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
            </svg>
        </a>
    </div>
</div>