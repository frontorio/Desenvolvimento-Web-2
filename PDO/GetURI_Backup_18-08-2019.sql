INSERT INTO `institution` (`id`, `name`) VALUES
(1, 'ifc'),
(2, 'unicamp'),
(3, 'uff'),
(4, 'ifrn'),
(5, 'unb-gama'),
(6, 'ifce');

INSERT INTO `sclass` (`id`, `name`, `idInst`) VALUES
(1, 'POO', 1),
(2, 'Algebra Linear', 1);

INSERT INTO `student` (`id`, `name`, `place`, `since`, `points`, `tried`, `submission`, `idInstitution`) VALUES
(4001, 'Gilmaicor', 46313, '2013-04-24', 129.7, 45, 100, 6),
(4044, 'Rodrigo Curvello', 169422, '2013-04-26', 14.9, 6, 12, 1),
(10582, 'Carlos Fran', 3646, '2013-11-06', 547.7, 170, 359, 4),
(13607, 'Gabriel Duarte', 2, '2014-02-10', 10761.5, 1703, 4468, 3),
(31538, 'SimiÃ£o Carvalho', 626, '2014-10-07', 1343.8, 305, 581, 5),
(34355, 'Erick Leonardo de Sousa Monteiro', 3, '2014-11-14', 9625.4, 1612, 4244, 2),
(114752, 'westefns souza', 8705, '2016-07-28', 369.9, 152, 274, 4);

INSERT INTO `student_has_sclass` (`idStudent`, `idSClass`) VALUES
(4044, 1),
(10582, 1),
(114752, 1),
(31538, 1),
(34355, 2);
