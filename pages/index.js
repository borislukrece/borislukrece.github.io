import Head from "next/head";
import NavBar from "@/components/navbar";
import Contact from "@/components/contact";
import styles from '@/styles/Home.module.css';
import { BsSearch,BsArrowRight,BsArrowLeft,BsStar, BsStarFill, BsStarHalf } from 'react-icons/bs';
import { useEffect } from "react";

export default function Home() {
    useEffect(() => {
        function handleScroll() {
            var frame = document.getElementById('frame_action');
            var distance = frame.offsetTop;
            if (window.pageYOffset >= distance) {
                frame.classList.add('sticky');
            } else {
                frame.classList.remove('sticky');
            }
          
            if (window.pageYOffset <= distance - frame.offsetHeight && frame.classList.contains('sticky')) {
                frame.classList.remove('sticky');
            }
        }
    
        window.addEventListener('scroll', handleScroll);
    
        return () => {
          window.removeEventListener('scroll', handleScroll);
        };
    }, []);

    return(
        <>
            <Head>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <link rel="icon" href="/favicon.ico" />
                <title>Home</title>
            </Head>
            <main className={styles.main}>
                <NavBar />

                <div className={styles.frame_action} id="frame_action">
                    <div className={styles.container_search}>
                        <div className={styles.input_search}>
                            <input type="text" name="search" placeholder="Rechercher un livre..."/>
                            <div className={styles.btn_search}>
                                <button type="submit"><BsSearch size={28}/></button>
                            </div>
                        </div>

                        <div className={styles.tendance_search}>
                            Tendance: L'Insoutenable Légèreté de l'être, Le Roman de Jim, Combats et métamorphoses d'une femme, La Carte postale.
                        </div>
                    </div>
                </div>

                <div className={styles.content_home}>
                    <div className={styles.section_title}>
                        Les livres les plus consultés aujourd'hui
                    </div>
                </div>

                <div className={styles.list_book}>
                    <div className={styles.grid_book}>
                        <div className={styles.book}>
                            <div className={styles.couverture}>
                                <img src="/id1/L'Insoutenable_Légèreté_de_l'être.jpg" alt="Couverture du livre" />
                            </div>
                            <div className={styles.informations}>
                                <div className={styles.book_title}>
                                    L'Insoutenable Légèreté de l'être
                                </div>
                                <div className={styles.book_author}>
                                    Milan Kundera
                                </div>
                                <div className={styles.book_category}>
                                    Drame romantique
                                </div>
                                <div className={styles.book_created_date}>
                                    1984
                                </div>
                                <div className={styles.book_evaluation}>
                                    <BsStarFill /><BsStarFill /><BsStarFill /><BsStarHalf /><BsStar />
                                </div>
                            </div>
                        </div>

                        <div className={styles.book}>
                            <div className={styles.couverture}>
                                <img src="/id1/Le_roman_de jin.jpg" alt="Couverture du livre" />
                            </div>
                            <div className={styles.informations}>
                                <div className={styles.book_title}>
                                    Le Roman de Jim
                                </div>
                                <div className={styles.book_author}>
                                    Pierric Bailly
                                </div>
                                <div className={styles.book_category}>
                                    Roman
                                </div>
                                <div className={styles.book_created_date}>
                                    2021
                                </div>
                                <div className={styles.book_evaluation}>
                                    <BsStarFill /><BsStarFill /><BsStarFill /><BsStarFill /><BsStarFill />
                                </div>
                            </div>
                        </div>

                        <div className={styles.book}>
                            <div className={styles.couverture}>
                                <img src="/id1/Combats_et_métamorphoses.jpg" alt="Couverture du livre" />
                            </div>
                            <div className={styles.informations}>
                                <div className={styles.book_title}>
                                    L'Insoutenable Légèreté de l'être
                                </div>
                                <div className={styles.book_author}>
                                    Milan Kundera
                                </div>
                                <div className={styles.book_category}>
                                    Drame romantique
                                </div>
                                <div className={styles.book_created_date}>
                                    1984
                                </div>
                                <div className={styles.book_evaluation}>
                                    <BsStarFill /><BsStarFill /><BsStarFill /><BsStarHalf /><BsStar />
                                </div>
                            </div>
                        </div>

                        <div className={styles.book}>
                            <div className={styles.couverture}>
                                <img src="/id1/La_carte_postale.jpg" alt="Couverture du livre" />
                            </div>
                            <div className={styles.informations}>
                                <div className={styles.book_title}>
                                    La Carte postale
                                </div>
                                <div className={styles.book_author}>
                                    Anne Berest
                                </div>
                                <div className={styles.book_category}>
                                    Roman
                                </div>
                                <div className={styles.book_created_date}>
                                    2021
                                </div>
                                <div className={styles.book_evaluation}>
                                    <BsStarFill /><BsStarFill /><BsStar /><BsStar /><BsStar />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div className={styles.pagination}>
                    <div className={styles.btn}>
                        <button className={styles.btn_back}><BsArrowLeft size={20} color="rgba(35,55,70,0.88)" /></button>
                        <button className={styles.btn_next}>Page suivante <BsArrowRight size={20}/> </button>
                    </div>
                    <div className={styles.page}>
                        Page 1 de 1
                    </div>
                </div>

                <Contact />
            </main>
        </>
    )
}