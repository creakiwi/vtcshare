DROP TABLE code;

CREATE TABLE IF NOT EXISTS `code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL DEFAULT 'uber',
  `code` varchar(100) NOT NULL,
  `weight` int(10) unsigned NOT NULL DEFAULT '10',
  `display` int(10) unsigned NOT NULL DEFAULT '0',
  `fuckedup` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


INSERT INTO code(code) VALUES('uberprems');
INSERT INTO code(code) VALUES('6xf6u');
INSERT INTO code(code) VALUES('Uberpierreyves');
INSERT INTO code(code) VALUES('mxwnj');
INSERT INTO code(code) VALUES('ytu0j');
INSERT INTO code(code) VALUES('GZIRA');
INSERT INTO code(code) VALUES('ARNGIM1');
INSERT INTO code(code) VALUES('KSO9M');
INSERT INTO code(code) VALUES('JU6E8');
INSERT INTO code(code) VALUES('X33KA');
INSERT INTO code(code) VALUES('uberD10');
INSERT INTO code(code) VALUES('a0p8s');
INSERT INTO code(code) VALUES('bjamd');
INSERT INTO code(code) VALUES('uberpolka');
INSERT INTO code(code) VALUES('A999U');
INSERT INTO code(code) VALUES('i7kst');
INSERT INTO code(code) VALUES('pu97o');
INSERT INTO code(code) VALUES('tamereenstring37');
INSERT INTO code(code) VALUES('16yed');
INSERT INTO code(code) VALUES('70kmy');
INSERT INTO code(code) VALUES('Uberpropal');
INSERT INTO code(code) VALUES('Ewd38');
INSERT INTO code(code) VALUES('mw4th');
INSERT INTO code(code) VALUES('tq8yz');
INSERT INTO code(code) VALUES('fu0ul');
INSERT INTO code(code) VALUES('kp7g2');
INSERT INTO code(code) VALUES('VC1DZ');
INSERT INTO code(code) VALUES('iloveborder');

ALTER TABLE code ADD type VARCHAR(100) NOT NULL DEFAULT 'uber';
ALTER TABLE code DROP INDEX code;
ALTER TABLE code ADD UNIQUE KEY code_unique(type,code);
