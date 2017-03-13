

/* Table : LIEN_PARENTE
 */
CREATE TABLE lien_parente(
	lie_id								SERIAL,
	lie_libelle							varchar(50),
	CONSTRAINT pk_lien_parente			PRIMARY KEY (lie_id)
);









/* Table : TYPE_CONTACT
 */
CREATE TABLE type_contact(
	typ_id								SERIAL,
	typ_libelle							varchar(50),
	CONSTRAINT pk_type_contact			PRIMARY KEY (typ_id)
);









/* Table : CEINTURE
 */
CREATE TABLE ceinture(
	cei_id								SERIAL,
	cei_libelle							varchar(50)								NOT NULL,
	cei_age_mini						int,
	CONSTRAINT pk_ceinture				PRIMARY KEY (cei_id)
);









/* Table : COURS
 */
CREATE TABLE cours(
	cou_id								SERIAL,
	cou_libelle							varchar(50)								NOT NULL,
	cou_age								int,
	CONSTRAINT pk_cours					PRIMARY KEY (cou_id)
);









/* Table : SAISON
 */
CREATE TABLE saison(
	sai_id								SERIAL,
	sai_debut							int										NOT NULL,
	sai_fin								int										NOT NULL,
	CONSTRAINT pk_saison				PRIMARY KEY (sai_id)
);









/* Table : POSITION
 */
CREATE TABLE position(
	pos_id								SERIAL,
	pos_libelle							varchar(30)								NOT NULL,
	CONSTRAINT pk_position				PRIMARY KEY (pos_id)
);









/* Table : FAMILLE
 */
CREATE TABLE famille(
	fam_id								SERIAL,
	fam_libelle							varchar(50)								NOT NULL,
	CONSTRAINT pk_famille				PRIMARY KEY (fam_id),
	CONSTRAINT c_fam_libelle_unique		UNIQUE(fam_libelle)
);









/* Table : ADHERENT
 * Dépend de :	FAMILLE
 *				POSITION
 */
CREATE TABLE adherent(
	adh_id								SERIAL,
	adh_nom								varchar(25),
	adh_prenom							varchar(25),
	adh_genre							char(1),
	adh_date_naissance					date,
	adh_adresse_postale					varchar(60),
	adh_adresse_complement				varchar(60),
	adh_code_postal						varchar(10),
	adh_ville							varchar(40),
	adh_certificat_medical				boolean,
	adh_licence							boolean,
	adh_licence_numero					varchar(25),
	adh_famille							int,
	adh_position						int,
	CONSTRAINT pk_adherent				PRIMARY KEY (adh_id),
	CONSTRAINT fk_adh_famille			FOREIGN KEY (adh_famille)				REFERENCES famille(fam_id),
	CONSTRAINT fk_adh_position			FOREIGN KEY (adh_position)				REFERENCES position(pos_id)
);









/* Table : Inscrire
 * Dépend de :	SAISON
 *				ADHERENT
 */
CREATE TABLE inscrire(
	ins_saison							int,
	ins_adherent						int,
	CONSTRAINT pk_inscrire				PRIMARY KEY (ins_saison, ins_adherent),
	CONSTRAINT fk_ins_saison			FOREIGN KEY (ins_saison)				REFERENCES saison(sai_id),
	CONSTRAINT fk_ins_adherent			FOREIGN KEY (ins_adherent)				REFERENCES adherent(adh_id),
	CONSTRAINT c_ins_saison_adherent_unique		UNIQUE(ins_saison, ins_adherent)
)








;/* Table : Suivre
 * Dépend de :	SAISON
 *				ADHERENT
 *				COURS
 */
CREATE TABLE suivre(
	sui_saison							int,
	sui_adherent						int,
	sui_cours							int,
	CONSTRAINT pk_suivre				PRIMARY KEY (sui_saison, sui_adherent, sui_cours),
	CONSTRAINT fk_sui_saison_adherent	FOREIGN KEY (sui_saison, sui_adherent)	REFERENCES inscrire(ins_saison, ins_adherent),
	CONSTRAINT fk_sui_cours				FOREIGN KEY (sui_cours)					REFERENCES cours(cou_id)
);









/* Table : Passer
 * Dépend de :	SAISON
 *				ADHERENT
 *				CEINTURE
 */
CREATE TABLE passer(
	pas_saison							int,
	pas_adherent						int,
	pas_ceinture						int,
	pas_date							date,
	CONSTRAINT pk_passer				PRIMARY KEY (pas_saison, pas_adherent, pas_ceinture),
	CONSTRAINT fk_pas_saison_adherent	FOREIGN KEY (pas_saison, pas_adherent)	REFERENCES inscrire(ins_saison, ins_adherent),
	CONSTRAINT fk_pas_ceinture			FOREIGN KEY (pas_ceinture)				REFERENCES ceinture(cei_id)
);









/* Table : CONTACT
 * Dépend de :	TYPE_CONTACT
 *				LIEN_PARENTE
 *				ADHERENT
 */
CREATE TABLE contact(
	con_id								SERIAL,
	con_contact							varchar(100)							NOT NULL,
	con_type							int										NOT NULL,
	con_lien_parente					int,
	con_adherent						int,
	CONSTRAINT pk_contact				PRIMARY KEY (con_id),
	CONSTRAINT fk_con_type				FOREIGN KEY (con_type)					REFERENCES type_contact(typ_id),
	CONSTRAINT fk_con_lien_parente		FOREIGN KEY (con_lien_parente)			REFERENCES lien_parente(lie_id),
	CONSTRAINT fk_con_adherent			FOREIGN KEY (con_adherent)				REFERENCES adherent(adh_id)
);


















/* LIEN_PARENTE
 * Entrées : 18
 */

insert into lien_parente (lie_libelle) values ('père');
insert into lien_parente (lie_libelle) values ('mère');
insert into lien_parente (lie_libelle) values ('grand-père paternel');
insert into lien_parente (lie_libelle) values ('grand-mère paternelle');
insert into lien_parente (lie_libelle) values ('grand-père maternel');
insert into lien_parente (lie_libelle) values ('grand-mère maternelle');
insert into lien_parente (lie_libelle) values ('grand frère');
insert into lien_parente (lie_libelle) values ('grande soeur');
insert into lien_parente (lie_libelle) values ('petit frère');
insert into lien_parente (lie_libelle) values ('petite soeur');
insert into lien_parente (lie_libelle) values ('jumeau');
insert into lien_parente (lie_libelle) values ('jumelle');
insert into lien_parente (lie_libelle) values ('oncle');
insert into lien_parente (lie_libelle) values ('tante');
insert into lien_parente (lie_libelle) values ('cousin');
insert into lien_parente (lie_libelle) values ('cousine');
insert into lien_parente (lie_libelle) values ('conjoint');
insert into lien_parente (lie_libelle) values ('conjointe');









/* TYPE_CONTACT
 * Entrées : 4
 */

insert into type_contact (typ_libelle) values ('fixe');
insert into type_contact (typ_libelle) values ('mobile');
insert into type_contact (typ_libelle) values ('fax');
insert into type_contact (typ_libelle) values ('mail');









/* POSITION
 * Entrées : 3
 */
 
insert into position (pos_libelle) values ('nouveau');
insert into position (pos_libelle) values ('renouvellement');
insert into position (pos_libelle) values ('essai');









/* CEINTURE
 * Entrées : 22
 */
 
insert into ceinture (cei_libelle) values ('blanche');
insert into ceinture (cei_libelle, cei_age_mini) values ('blanche 1 liseré jaune', 5);
insert into ceinture (cei_libelle, cei_age_mini) values ('blanche 2 liserés jaunes', 6);
insert into ceinture (cei_libelle, cei_age_mini) values ('blanche-jaune', 7);
insert into ceinture (cei_libelle, cei_age_mini) values ('jaune', 8);
insert into ceinture (cei_libelle, cei_age_mini) values ('jaune-orange', 9);
insert into ceinture (cei_libelle, cei_age_mini) values ('orange', 10);
insert into ceinture (cei_libelle, cei_age_mini) values ('orange-verte', 11);
insert into ceinture (cei_libelle, cei_age_mini) values ('verte', 12);
insert into ceinture (cei_libelle, cei_age_mini) values ('bleue', 13);
insert into ceinture (cei_libelle, cei_age_mini) values ('violette', 13);
insert into ceinture (cei_libelle, cei_age_mini) values ('marron', 14);
insert into ceinture (cei_libelle, cei_age_mini) values ('noire 1e dan', 15);
insert into ceinture (cei_libelle, cei_age_mini) values ('noire 2e dan', 17);
insert into ceinture (cei_libelle, cei_age_mini) values ('noire 3e dan', 20);
insert into ceinture (cei_libelle, cei_age_mini) values ('noire 4e dan', 24);
insert into ceinture (cei_libelle, cei_age_mini) values ('noire 5e dan', 29);
insert into ceinture (cei_libelle, cei_age_mini) values ('rouge-blanche 6e dan', 35);
insert into ceinture (cei_libelle, cei_age_mini) values ('rouge-blanche 7e dan', 42);
insert into ceinture (cei_libelle, cei_age_mini) values ('rouge-blanche 8e dan', 50);
insert into ceinture (cei_libelle, cei_age_mini) values ('rouge 9e dan', 60);
insert into ceinture (cei_libelle, cei_age_mini) values ('rouge 10e dan', 93);









/* SAISON
 * Entrées : 6
 */
 
insert into saison (sai_debut, sai_fin) values (2015, 2016);
insert into saison (sai_debut, sai_fin) values (2016, 2017);
insert into saison (sai_debut, sai_fin) values (2017, 2018);
insert into saison (sai_debut, sai_fin) values (2018, 2019);
insert into saison (sai_debut, sai_fin) values (2019, 2020);
insert into saison (sai_debut, sai_fin) values (2020, 2021);









/* COURS
 * Entrées : 13
 */
 
insert into cours (cou_libelle, cou_age) values ('Oregano', 5);
insert into cours (cou_libelle, cou_age) values ('Gentamicin Sulfate', 6);
insert into cours (cou_libelle, cou_age) values ('Instant Hand Sanitizer', 7);
insert into cours (cou_libelle, cou_age) values ('Kinesys', 8);
insert into cours (cou_libelle, cou_age) values ('Benztropine mesylate', 9);
insert into cours (cou_libelle, cou_age) values ('Neomycin', 10);
insert into cours (cou_libelle, cou_age) values ('Ciprofloxacin', 11);
insert into cours (cou_libelle, cou_age) values ('Geodon', 12);
insert into cours (cou_libelle, cou_age) values ('Mesylate', 13);
insert into cours (cou_libelle, cou_age) values ('Family Dollar', 14);
insert into cours (cou_libelle, cou_age) values ('Captopril', 15);
insert into cours (cou_libelle) values ('Bodycology');
insert into cours (cou_libelle) values ('Safeway');