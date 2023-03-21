import Head from "next/head";
import NavBar from "@/components/navbar";
import Contacts from "@/components/contact";
import styles from '@/styles/Profil.module.css';

export default function Profil() {
    return(
        <>
            <Head>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <link rel="icon" href="/favicon.ico" />
                <title>Mon profil</title>
            </Head>
            <main className={styles.main}>
                <NavBar />

                <div className={styles.frame_action} id="frame_action">
                    <div className={styles.container_search}>
                        <div className={styles.tendance_search}>
                            Cette page contient toutes les données, détails et paramètres associés à votre compte utilisateur.
                        </div>
                    </div>
                </div>

                <div className={styles.content}>
                    <div className={styles.section_title}>
                        Informations sur le compte
                    </div>
                </div>

                <form className={styles.form_profil}>
                    <div className={styles.input_group}>
                        <div className={styles.field}>
                            <label htmlFor="fullName">Nom complet</label>
                            <input type="name" id="fullName" name="fullName" placeholder="Ahoty Boris Lukrece" />
                        </div>

                        <div className={styles.field}>
                            <label htmlFor="username">Nom d'utilisateur</label>
                            <input type="email" id="username" name="username" placeholder="borislukrece" />
                        </div>

                        <div className={styles.field}>
                            <label>Email</label>
                            <input type="email" className="disabled" placeholder="ahotyboris.ab@gmail.com" disabled/>
                        </div>

                        <div className={styles.btn_send}>
                            <button className={styles.btn_cancel}>Annuler</button>
                            <button className={styles.btn_save}>Enregistrer</button>
                        </div>
                    </div>
                </form>

                <Contacts />
            </main>
        </>
    )
}