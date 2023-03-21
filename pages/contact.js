import Head from "next/head";
import NavBar from "@/components/navbar";
import Contacts from "@/components/contact";
import styles from '@/styles/Contacts.module.css';

export default function Contact(){
    return(
        <>
            <Head>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <link rel="icon" href="/favicon.ico" />
                <title>Contact</title>
            </Head>
            <main className={styles.main}>
                <NavBar />

                <div className={styles.frame_action} id="frame_action">
                    <div className={styles.container_search}>
                        <div className={styles.tendance_search}>
                            Si vous avez des questions concernant ce site, veuillez remplir le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.
                        </div>
                    </div>
                </div>

                <div className={styles.content}>
                    <div className={styles.section_title}>
                        Formulaire de contact
                    </div>
                </div>

                <form className={styles.form_contact}>
                    <div className={styles.input_group}>
                        <div className={styles.field}>
                            <label htmlFor="fullName">Nom complet</label>
                            <input type="name" id="fullName" name="fullName" placeholder="Nom complet" />
                        </div>

                        <div className={styles.field}>
                            <label htmlFor="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email" />
                        </div>

                        <div className={styles.field}>
                            <label htmlFor="subject">Sujet</label>
                            <input type="text" id="subject" name="subject" placeholder="Sujet" />
                        </div>

                        <div className={styles.field}>
                            <label htmlFor="message">Message</label>
                            <textarea id="message" name="message" placeholder="Message..."></textarea>
                        </div>

                        <div className={styles.btn_send}>
                            <button className={styles.btn}>Envoyer</button>
                        </div>
                    </div>
                </form>

                <Contacts />
            </main>
        </>
    )
}