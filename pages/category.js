import Head from "next/head";
import NavBar from "@/components/navbar";
import Contacts from "@/components/contact";
import styles from '@/styles/Category.module.css';

export default function Category(){
    return(
        <>
            <Head>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <link rel="icon" href="/favicon.ico" />
                <title>Catégories</title>
            </Head>
            <main className={styles.main}>
                <NavBar />
            
                <div className={styles.frame_action} id="frame_action">
                    <div className={styles.container_search}>
                        <div className={styles.tendance_search}>
                            Explorez nos plus grand catalogue de livre
                        </div>
                    </div>
                </div>

                <div className={styles.content}>
                    {/* La fiction */}
                    <div className={styles.fiction}>
                        <div className={styles.section_title}>
                            <a href="#">La fiction</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">Romans</a>, 
                            <a href="#">nouvelles</a>, 
                            <a href="#">contes</a>, 
                            <a href="#">pièces de théâtre</a>, 
                            <a href="#">poésie</a>, 
                            <a href="#">autres</a>.
                        </div>
                    </div>

                    {/* La non-fiction */}
                    <div className={styles.non_fiction}>
                        <div className={styles.section_title}>
                            <a href="#">La non-fiction</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">Biographies</a>, 
                            <a href="#">essais</a>, 
                            <a href="#">livres de cuisine</a>, 
                            <a href="#">livres d'histoire</a>, 
                            <a href="#">livres de voyage</a>, 
                            <a href="#">autres</a>.
                        </div>
                    </div>

                    {/* Les manuels scolaires */}
                    <div className={styles.manuels_scolaires}>
                        <div className={styles.section_title}>
                            <a href="#">Les manuels scolaires</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">Manuels scolaires pour les élèves du primaire du secondaire ou de l'université</a>, 
                            <a href="#">autres</a>.
                        </div>
                    </div>

                    {/* Les livres pour enfants */}
                    <div className={styles.livres_enfants}>
                        <div className={styles.section_title}>
                            <a href="#">Les livres pour enfants</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">Albums illustrés</a>, 
                            <a href="#">livres de coloriage</a>, 
                            <a href="#">livres de contes pour enfants</a>,
                            <a href="#">autres</a>.
                        </div>
                    </div>

                    {/* Les livres de référence */}
                    <div className={styles.livres_reference}>
                        <div className={styles.section_title}>
                            <a href="#">Les livres de référence</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">Dictionnaires</a>, 
                            <a href="#">encyclopédies</a>, 
                            <a href="#">guides pratiques</a>, 
                            <a href="#">autres</a>.
                        </div>
                    </div>

                    {/* Les livres religieux */}
                    <div className={styles.livres_religieux}>
                        <div className={styles.section_title}>
                            <a href="#">Les livres religieux</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">La Bible</a>, 
                            <a href="#">le Coran</a>, 
                            <a href="#">le Talmud</a>, 
                            <a href="#">autres</a>.
                        </div>
                    </div>

                    {/* Les livres d'art */}
                    <div className={styles.livres_art}>
                        <div className={styles.section_title}>
                            <a href="#">Les livres d'art</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">Livres sur l'histoire de l'art</a>, 
                            <a href="#">les artistes</a>, 
                            <a href="#">les techniques</a>, 
                            <a href="#">les musées</a>,
                            <a href="#">autres</a>.
                        </div>
                    </div>

                    {/* Les livres de loisirs */}
                    <div className={styles.livres_loisirs}>
                        <div className={styles.section_title}>
                            <a href="#">Les livres de loisirs</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">Livres de jeux</a>, 
                            <a href="#">de puzzles</a>, 
                            <a href="#">de sports</a>, 
                            <a href="#">de loisirs créatifs</a>, 
                            <a href="#">de jardinage</a>, 
                            <a href="#">autres</a>.
                        </div>
                    </div>

                    {/* Les livres de développement personnel */}
                    <div className={styles.livres_developpement_personnel}>
                        <div className={styles.section_title}>
                            <a href="#">Les livres de développement personnel</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">Livres de psychologie</a>, 
                            <a href="#">de développement personnel</a>, 
                            <a href="#">de méditation</a>, 
                            <a href="#">autres</a>.
                        </div>
                    </div>

                    {/* Les livres éducatifs */}
                    <div className={styles.livres_educatifs}>
                        <div className={styles.section_title}>
                            <a href="#">Les livres éducatifs</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">Livres pour apprendre une langue étrangère</a>, 
                            <a href="#">des compétences informatiques</a>, 
                            <a href="#">des compétences en gestion</a>, 
                            <a href="#">autres</a>.
                        </div>
                    </div>

                    {/* Les livres de science-fiction et de fantasy */}
                    <div className={styles.livres_science_fiction_fantasy}>
                        <div className={styles.section_title}>
                            <a href="#">Les livres de science-fiction et de fantasy</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">Romans</a>, 
                            <a href="#">nouvelles</a>, 
                            <a href="#">sagas</a>, 
                            <a href="#">autres</a>.
                        </div>
                    </div>

                    {/* Les livres de crime et de suspense */}
                    <div className={styles.livres_crime_suspense}>
                        <div className={styles.section_title}>
                            <a href="#">Les livres de crime et de suspense</a>
                        </div>
                        <div className={styles.list_category}>
                            <a href="#">Romans policiers</a>, 
                            <a href="#">thrillers</a>, 
                            <a href="#">romans d'espionnage</a>, 
                            <a href="#">autres</a>.
                        </div>
                    </div>
                </div>

                <Contacts />
            </main>
        </>
    )
}