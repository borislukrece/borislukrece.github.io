import styles from '@/styles/Contact.module.css';
import { BsTwitter, BsFacebook, BsLinkedin, BsEnvelopeAtFill } from 'react-icons/bs';

export default function Contact (){
    return(
        <>
            <footer className={styles.my_footer}>
                <div className={styles.my_footer_content}>
                    <div className={styles.legal}>
                        <span>Légal</span>
                        <a href="#">Conditions générales</a>
                        <a href="#">Politique de cookies</a>
                    </div>

                    <div className={styles.info}>
                        <span>Information</span>
                        
                        <a>+225 05 44 95 57 67</a>
                        <a href="#">À propos de nous</a>
                        <a href="mailto:ahotyboris.ab@gmail.com">ahotyboris.ab@gmail.com</a>

                        <div className={styles.social_media_contact}>
                            <a className={styles.twitter} href="" target="_blank">
                                <BsTwitter size={26} />
                            </a>
                            <a className={styles.facebook} href="https://www.facebook.com/ahoty.single/" target="_blank">
                                <BsFacebook size={26} />
                            </a>
                            <a className={styles.linkedin} href="https://www.linkedin.com/in/boris-ahoty-47bbb818b" target="_blank">
                                <BsLinkedin size={26} />
                            </a>
                            <a className={styles.email} href="mailto:ahotyboris.ab@gmail.com">
                                <BsEnvelopeAtFill size={26} />
                            </a>
                        </div>
                    </div>
                    <div className={styles.newsletter}>
                        <span>Subscribe to my Newsletter</span>
                        <form method="POST" action="server/newsletter.php">
                            <input type="text" className="form-control" placeholder="Entrer votre email ici*" name="email" />
                            <button type="submit" className="btn">Rejoindre</button>
                        </form>
                    </div>
                </div>
            </footer>
        </>
    )
}