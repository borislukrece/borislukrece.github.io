<div style="width: 5vw;height: 100vh;background-image: linear-gradient(#317AC1, #497B96);overflow: hidden;">
    <div style="
        width: 100%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 1vw;
    ">
        <a href="/menu/profil" data-toggle="tooltip" title="Profil" style="
            width: 4vw; 
            height: 4vw;
            background: white;
            color: gray;
            padding: 1vw;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 100%;
            overflow: hidden;
        ">
            {{-- <img src="{{asset('img/profil.png')}}" alt="Profil" style="
                width: 3vw; 
                height: auto;
            "> --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
            </svg>
        </a>
    </div>
    {{-- <div style="
        width: 100%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 1vw;
    ">
        <a href="/tableau-de-bord" data-toggle="tooltip" title="Tableau de bord" style="
            width: 2.5rem;
            height: 2.5rem;
            background:#D4D3DC;
            border-radius: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
            <?php
            $route = Route::current()->uri;
            if ($route === 'tableau-de-bord') {
            ?>
            color: #EC9628;
            <?php
                }
            ?>
        ">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <g>
                    <path class="st0" d="M428.1,199.7c0-51.2-1.3-102.4-2.2-153.7C425.4,18.1,415.2,6.1,388,0.5l-32,0.9c-56.9,3.4-113.7,6.9-170.6,9.8   c-15.2,0.8-23.2,7.6-25.9,22.9c-21.2,122.5-42.5,245-64,367.4c-3.7,21-0.9,24.8,19.7,30.3l183.1,47.9l120.7,31.4   c3.1-17,8.4-32.7,8.5-48.4C428.7,375,428.5,287.3,428.1,199.7z M207.2,320.2c-21.3,7.9-35.6,27.9-36.3,50.5   c-1.3,17.5,7.4,31.1,19,43.1c5.1,5.1,11.2,10.6,3.2,16.1c-5.7,2.1-12,1.2-16.9-2.4c-15.9-14.1-21.5-33.1-21.8-54.4   c-0.2-24.6,11-47.8,30.3-63c5-4.1,9-5.6,15.2-7.3c5.5-0.4,14.4-1.6,16.8,4.8C216.7,311,217.6,315.5,207.2,320.2z M259.7,426.3   c-7.6,7.2-16.6,12.9-26.3,16.7c-5.3,0.5-10.5-1.8-13.7-6.1c-1.8-3.5-0.9-10.2,3.5-14.9c2.6-2.8,7.1-4.6,10.6-7   c28.3-19,34.3-50.4,15.2-78.5c-2.2-3.2-5.7-6.6-7.4-9.6c-3-5.2-1.5-10.8,1.2-13.7c4.5-2.7,10.1-2.9,14.8-0.6   c14.2,9.8,20.2,24.8,22.5,41.5c0.6,4.7,0.9,7.2,1.1,12C282.9,387.5,274.7,411,259.7,426.3z M325,266.4   c-57.9-6.7-115.9-13.6-173.7-20.7c-4.4-1-8.7-2.4-12.8-4.1c8.1-49.8,16.1-98.7,24.2-147.7c3-18.4,5.5-36.9,9.7-55   c1.7-5.3,5.9-9.4,11.2-11c66.9-3.1,133.7-5.5,203.7-8c-4.3,27.7-8.1,53.1-12.3,78.4c-8.4,49.9-16.9,99.8-25.6,149.7   C346.3,264.6,341.6,268.3,325,266.4z M370.8,471.7c-5.6-3.3-7.9-16.5-7.4-25c1.4-21.9,5.1-43.7,8-65.7   c12.2-89.1,24.4-178.2,36.7-267.3c0.5-2.5,1.2-4.9,2.1-7.3l3.3,0.6l0.1,378.6C398,480.9,383,478.8,370.8,471.7z"/>
                    <path class="st0" d="M289.9,48.1c-4,0.7-7.4,3.4-9.1,7.2c-4.7,24.3-8.5,48.7-12.8,74.3c23,1.1,44.4,2.8,65.7,2.7   c5.7-0.9,10.6-4.5,13-9.8c5.1-24.3,8.5-48.9,12.8-74.7C335.7,47.8,312.7,47.3,289.9,48.1z"/>
                    <path class="st0" d="M160.7,224.6l71.1,8.4c4.4-27.5,8.7-53.9,13.2-81.4l-71.9-4.2C168.8,173.6,164.8,198.9,160.7,224.6z"/>
                    <path class="st0" d="M203,48.7c-5.1,0.5-9.6,3.5-12,7.9c-5.1,22-8.7,44.3-13.2,69l70.7,3.9L262,48.3C241.1,48.3,222,47.9,203,48.7z   "/>
                </g>
            </svg>
        </a>
    </div> --}}
    <a href="/" data-toggle="tooltip" title="Accueil" style="
        width: 100%; 
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 2rem;
    "><i class="bi bi-house-door" style="
        font-size: 1.5rem; 
        color: #FFFFFF;
        <?php
            $route = Route::current()->uri;
            if ($route === '/') {
        ?>
        color: #EC9628;
        <?php
            }
        ?>
    "></i></a>
    <a href="/menu/profil" data-toggle="tooltip" title="Menu" style="
        width: 100%; 
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    "><i class="bi bi-grid" style="
        font-size: 1.5rem; 
        color: #FFFFFF;
        <?php
            $route = Route::current()->uri;

            $string = $route;
            $words = explode('/', $string);
            $first_word = $words[0];
            
            if ($first_word === 'menu') {
        ?>
        color: #EC9628;
        <?php
            }
        ?>
    "></i></a>
    <a href="/rapport-individuel" data-toggle="tooltip" title="Rapport Individuel" style="
        width: 100%; 
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    "><i class="bi bi-card-text" style="
        font-size: 1.5rem; 
        color: #FFFFFF;
        <?php
            $route = Route::current()->uri;
            if ($route === 'rapport-individuel') {
        ?>
        color: #EC9628;
        <?php
            }
        ?>
    "></i></a>
</div>