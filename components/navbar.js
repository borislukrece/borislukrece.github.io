import Image from "next/image";
import Link from 'next/link';
import styles from '@/styles/Navbar.module.css';
import { BsBellFill, BsX, BsAt, BsEyeSlashFill, BsEyeFill, BsPersonFill, BsEnvelopeAtFill } from 'react-icons/bs';
import { useState, useEffect } from "react";
import Modal from 'react-modal';

Modal.setAppElement('#__next');

export default function NavBar() {
    const [count, setCount] = useState("none");
    const [showPassword, setShowPassword] = useState(false); 
    const [isOpen, setIsOpen] = useState(false);

    const toggleShowPassword = () =>  {
        setShowPassword(!showPassword);
    }

    const handleOpenModal = () => {
        setIsOpen(true);
    };

    const handleCloseModal = () => {
        setIsOpen(false);
    };

    return(
        <>
            <div className={styles.bg_navbar}>
                <nav className="navbar navbar-expand-lg">
                    <div className="container-fluid">
                        <Link href="/">
                            <span className="navbar-brand">
                                <Image src="/logo.png" alt="logo"
                                    width={65}
                                    height={37}
                                    priority 
                                />
                            </span>
                        </Link>
                        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span className="navbar-toggler-icon"></span>
                        </button>
                        <div className="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                                <li className="nav-item">
                                    <Link href="/">
                                        <span className="nav-link">Home</span>
                                    </Link>
                                </li>
                                <li className="nav-item">
                                    <Link href="/category">
                                        <span className="nav-link">Catégories</span>
                                    </Link>
                                </li>
                                <li className="nav-item">
                                    <Link href="/contact">
                                        <span className="nav-link">Contact</span>
                                    </Link>
                                </li>
                                <li className="nav-item dropdown">
                                    <a className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Profil
                                    </a>
                                    <ul className="dropdown-menu">
                                        <li>
                                            <Link href="/profil">
                                                <span className="dropdown-item">Mon profil</span>
                                            </Link>
                                        </li>
                                        <li><a className="dropdown-item" href="#">Mes livres</a></li>
                                        <li><hr className="dropdown-divider" /></li>
                                        <li><span className="dropdown-item" style={{cursor: "pointer"}}>Se déconnecter</span></li>
                                    </ul>
                                </li>
                                <li className="nav-item">
                                    <span onClick={handleOpenModal} style={{cursor: "pointer"}}>
                                        <span className="nav-link btn_signin">S'identifier</span>
                                    </span>
                                </li>
                            </ul>
                            <div className={styles.notification}>
                                <li className="nav-item">
                                    <span className="nav-link btn-notifs" onClick={() => setCount("block")}><BsBellFill size={22} /> Notification</span>
                                </li>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <Modal isOpen={isOpen} onRequestClose={handleCloseModal}>
                <form className={styles.form_identification}>
                    <div className={styles.container_identification}>
                        <div className={styles.left}>
                            <div className={styles.left_title}>Se connecter</div>

                            <div className="col-md-4 mb-3">
                                <label htmlFor="username">Nom d'utilisateur</label>
                                <div className="input-group">
                                    <div className="input-group-prepend">
                                        <span className="input-group-text"><BsAt size={26}/></span>
                                    </div>
                                    <input type="username" className="form-control is-invalid" id="username" placeholder="" aria-describedby="inputGroupPrepend" required />
                                    <div className="invalid-feedback">
                                        Veuillez entrer un nom d'utilisateur.
                                    </div>
                                </div>
                            </div>

                            <div className="col-md-4 mb-3">
                                <label htmlFor="mdp">Mot de passe</label>
                                <div className="input-group">
                                    <div className="input-group-prepend" onClick={toggleShowPassword}>
                                        <span className="input-group-text">
                                            
                                            {showPassword ? <BsEyeSlashFill size={26}/> : <BsEyeFill size={26}/>}
                                        </span>
                                    </div>
                                    <input type={showPassword ? "text" : "password"} className="form-control" id="mdp" placeholder="" aria-describedby="inputGroupPrepend" required />
                                    <div className="invalid-feedback">
                                        Veuillez entrer un mot de passe.
                                    </div>
                                </div>
                            </div>

                            <div className={styles.remember}>
                                <div className="form-check mb-2">
                                    <input className="form-check-input" type="checkbox" id="autoSizingCheck" />
                                    <label className="form-check-label" for="autoSizingCheck">
                                        Se souvenir
                                    </label>
                                </div>

                                <div className={styles.mdp_forgot}>
                                    Mot de passe oublié ?
                                </div>
                            </div>

                            <button type="button"className={styles.btn_login}>
                                Se connecter
                            </button>
                        </div>
                        <div className={styles.right}>
                            <div className={styles.left_title}>S'enregistrer</div>

                            <div className="col-md-4 mb-3">
                                <label htmlFor="signup_fullname">Nom complet</label>
                                <div className="input-group">
                                    <div className="input-group-prepend">
                                        <span className="input-group-text"><BsPersonFill size={26}/></span>
                                    </div>
                                    <input type="text" className="form-control" id="signup_fullname" placeholder="" aria-describedby="inputGroupPrepend" required />
                                    <div className="invalid-feedback">
                                        Veuillez entrer votre nom complet.
                                    </div>
                                </div>
                            </div>

                            <div className="col-md-4 mb-3">
                                <label htmlFor="signup_username">Nom d'utilisateur</label>
                                <div className="input-group">
                                    <div className="input-group-prepend">
                                        <span className="input-group-text"><BsAt size={26}/></span>
                                    </div>
                                    <input type="username" className="form-control" id="signup_username" placeholder="" aria-describedby="inputGroupPrepend" required />
                                    <div className="invalid-feedback">
                                        Veuillez entrer un nom d'utilisateur.
                                    </div>
                                </div>
                            </div>

                            <div className="col-md-4 mb-3">
                                <label htmlFor="signup_email">Email</label>
                                <div className="input-group">
                                    <div className="input-group-prepend">
                                        <span className="input-group-text"><BsEnvelopeAtFill size={26}/></span>
                                    </div>
                                    <input type="text" className="form-control" id="signup_email" placeholder="" aria-describedby="inputGroupPrepend" required />
                                    <div className="invalid-feedback">
                                        Veuillez entrer votre email.
                                    </div>
                                </div>
                            </div>

                            <button type="button"className={styles.btn_login}>
                                S'enregistrer
                            </button>
                        </div>
                    </div>
                </form>
            </Modal>

            <div style={{width: "100vw", height: "100vh", display: `${count}`, position: "fixed", top: 0, background: "rgba(0, 0, 0, 0.3)"}}>
                <div style={{width: "20rem", height: "75vh", background: "white", borderRadius: "10px 0 0 0", position: "absolute", right: "0", bottom: "0"}}>
                    <div>
                        <div style={{width: "100%", height: "8vh", background: "rgba(0, 0, 0, 0.09)", display: "flex"}}>
                            <div style={{width: "80%", height: "100%",fontWeight: "bold", paddingLeft: "10px", display: "flex", alignItems: "center"}}>
                                Notifications
                            </div>
                            <div style={{width: "20%", height: "100%", display: "flex", alignItems: "center", justifyContent: "center"}}>
                                <div style={{padding: "10px", cursor: "pointer"}} onClick={() => setCount("none")}>
                                    <BsX color="black" size={26}/>
                                </div>
                            </div>
                        </div>
                        <div style={{marginTop: "1rem"}}>
                            <div style={{width: "100%", height: "100%", borderRadius: "10px", display: "flex", alignItems: "center", justifyContent: "center"}}>
                                <div style={{width: "2rem", height: "2rem", background: "rgba(0, 0, 0, 0.43)", borderRadius: "10px", display: "flex", alignItems: "center", justifyContent: "center"}}>
                                    <BsBellFill size={20} />
                                </div>
                            </div>
                            <div style={{width: "100%", height: "100%", marginTop: "1rem", fontWeight: "bold", textAlign: "center", borderRadius: "10px", display: "flex", alignItems: "center", justifyContent: "center"}}>
                                Aucune notification à afficher pour l'instant
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}