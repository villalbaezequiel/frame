<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //
    static public function getAllContracts($status = 1)
    {
      return Contract::where('active', $status)->get();
    }

    static public function getName($id)
    {
      $contract = Contract::find($id);

      if($contract){
        return $contract->name;
      }
    }

    static public function getContractEventual($crew_name_full, $crew_addres_full, $crew_location, $crew_cp, $crew_dni, $crew_start_contract, $crew_function_sat, $crew_salary_text, $crew_salary, $crew_name_project, $crew_email)
    {
      $today = date('d/m/Y');

      $message = "<h1 style='font-size: 20px;'><strong>CONTRATO DE TRABAJO EVENTUAL</strong></h1>

      <p>Entre la firma FZERO S.R.L., representada en este acto por el Sr. HERNAN PELLEGRINI, DNI N° 26.116.576, con domicilio en  Tronador Nº 671, CABA (1427), en adelante “La Empleadora” y el Sr/Sra. $crew_name_full, con domicilio en $crew_addres_full, $crew_location($crew_cp). DNI Nº $crew_dni, por la otra parte, en adelante “El Empleado” se celebra el presente contrato de trabajo de carácter eventual sujeto a la legislación vigente (cf. arts. 8 y ccs. CCT N° 634/11 SATSAID – CAPIT; 90, 93 y ss. y ccs. R.C.T.), y que se encuentra regulado por las siguientes cláusulas:</p>

      <p><strong>PRIMERA:</strong> La Empleadora contrata al Sr/a. <strong>$crew_name_full</strong>, y éste acepta desempeñarse como <strong>$crew_function_sat</strong>.</p>

      <p><strong>SEGUNDA:</strong> El Empleado se compromete a cumplir con las obligaciones y tareas inherentes a sus funciones, prestando servicios durante los siguientes días y horarios: lunes a viernes durante 7 horas 15 minutos, los cuales podrán estar sujetos a modificaciones puntuales y/o circunstancias observadas por La Empleadora. Su lugar de trabajo será en Tronador 671, CABA, pudiendo modificarse por indicación de La Empleadora.</p>

      <p><strong>TERCERA:</strong> La eventualidad del presente contrato de trabajo surge de la necesidad de cubrir en forma extraordinaria y transitoria el puesto indicado, originado por la producción única y exclusiva del proyecto <strong>“{$crew_name_project}”.</strong></p>
      <p>Una vez finalizados los motivos que dieron lugar a su celebración, el contrato de trabajo se considerará extinguido de pleno derecho en los términos del artículo 73 y 74 de la Ley 24.013.</p>
      <p>El Empleado se notifica y consiente expresamente que su contratación es de naturaleza especial en razón de necesidades operacionales extraordinarias de La Empleadora en dicho Proyecto. Dada su magnitud y cantidad de personal técnico especializado requeridos, no es viable para la Empleadora afrontarlo con su personal de planta permanente. Se trata de un requerimiento extraordinario de personal necesario para el Proyecto por el estricto plazo de vigencia detallado en el presente (conforme régimen de los arts. 93, 95 y ccs. Ley de Contrato de Trabajo y art. 8 CCT Nº 634/11 SATSAID – CAPIT).</p>
      <p>El Empleado cumplirá las tareas propias de su oficio bajo las instrucciones emanadas del personal directivo de La Empleadora o de quienes ésta indique, debiendo respetarlas y cumplirlas con idoneidad, eficacia y diligencia.</p>
      <p>El Empleado se desempeñará con dedicación exclusiva y “full-time”, en los términos  y condiciones generales acordados en el presente, y los que se pudieran oportunamente convenir entre las Partes en particular para proyectos y trabajos específicos.</p>

      <p><strong>CUARTA:</strong> Se acuerda que el Sr/a. <strong>$crew_name_full</strong> percibirá una remuneración bruta de Pesos $crew_salary_text. ($crew_salary), que se abonará en forma mensual, por período vencido del 1 al 5 de cada mes.</p>

      <p><strong>QUINTA:</strong> El plazo de vigencia del presente contrato será a partir del día $crew_start_contract</p>

      <p><strong>SEXTA:</strong> El Empleado cumplirá las tareas propias de su oficio bajo las directivas emanadas del personal directivo de La Empleadora o de quienes ésta indique, debiendo respetarlas y cumplirlas con idoneidad y diligencia.</p>
      <p>Una vez concluido el plazo señalado cesará la relación laboral. El Empleado a la finalización del contrato percibirá los salarios que se hubieran devengado, los importes proporcionales por eventuales vacaciones no gozadas y sueldo anual complementario.</p>

      <p><strong>SEPTIMA:</strong> Para todos los efectos emergentes del presente contrato, las partes constituyen domicilios en los indicados en el encabezamiento, donde se tendrán por válidas  y realizadas todas las comunicaciones que se cursaren hasta tanto no notifiquen en forma fehaciente la constitución de un nuevo domicilio a los mismos efectos.</p>

      <p><strong>OCTAVA:</strong> Notificaciones:Comunicaciones vía email</p>
      <p>Las comunicaciones relacionadas con la ejecución operativa de este contrato de trabajo eventual se cursarán vía email (con constancia de entrega y constancia de recepción), a las siguientes direcciones:</p>
      <p>Comunicaciones a domicilios:</p>
      <p>Se dirigirán a los siguientes domicilios:</p>
      <p>A La Empleadora: Hernan Pellegrini (hernan.pellegrini@frame.com.ar)</p>
      <p>A El Empleado: <strong>$crew_name_full ($crew_email)</strong></p>

      <p><strong>NOVENA:</strong> El Empleado acepta y reconoce que La Empleadora y sus subsidiarias, sucesores, cesionarios y licenciatarios tendrán el derecho y la propiedad exclusiva de todos los resultados y los productos de sus Servicios en cualquier etapa de desarrollo y que los derechos exclusivos de La Empleadora  incluyen, sin limitación, el derecho de autor y derechos conexos, el derecho de reproducción, el derecho de adaptación, el derecho de traducción, el derecho de doblaje y subtitulado, el derecho de exhibición, el derecho de promoción, el derecho de comunicación pública, el derecho de distribución, el derecho de crear obras derivadas y el derecho de alquilar y/o licenciar el Trabajo, libre de todo gravamen, reclamo y/o cargo. Sin que ello signifique limitar lo antedicho, acepto y reconozco que en el futuro pueden surgir o reconocerse nuevos derechos sobre el Trabajo conforme a las leyes aplicables y/o bajo cualquier sistema jurídico (en adelante, los “Nuevos Derechos de Explotación”) y tengo la voluntad y por el presente le otorgo y cedo a La Empleadora  todos y cada uno de tales Nuevos Derechos de Explotación en y sobre el Trabajo.</p>

      <p><strong>DECIMA:</strong> El Empleado entiende que durante la prestación de sus Servicios, podrá tener acceso a cierta información o material de propiedad de o relacionada con La Empleadora que no sea accesible o conocida por el público en general (“Información Confidencial”). Con respecto a ello, El Empleado conviene que: (a) no utilizará, directa ni indirectamente, la Información Confidencial para ningún fin ajeno al cual fue contratado, y que (b) no divulgará, directa ni indirectamente, dicha Información Confidencial a ninguna persona, empresa, sociedad, asociación u otra entidad por ninguna razón o propósito. A su vez  entiende que cualquier violación o intento de violación a las condiciones precedentes podría causar a La Empleadora un daño irreparable y en consecuencia, La Empleadora tendrá derecho a solicitar las medidas precautorias que estime pertinentes.</p>

      <p>PREVIA LECTURA Y RATIFICACION; se firman 2 (dos) ejemplares de un mismo tenor en la ciudad de Buenos Aires, en el dia $today</p>

      <ul>
        <li>Firma:</li>
        <li>Aclaración: <strong>$crew_name_full</strong></li>
        <li>DNI: <strong>$crew_dni</strong></li>
      </ul>";

      return $message;
    }

    static public function getContractPlazoFijo($crew_name_full, $crew_addres_full, $crew_location, $crew_cp, $crew_dni, $crew_cuit, $crew_start_contract, $crew_finish_contract, $crew_function_sat, $crew_salary_text, $crew_salary, $crew_name_project, $crew_email, $center_cost)
    {
      $today = date('d/m/Y');

      $message = "<h1 style='font-size: 20px;'><strong>CONTRATO PLAZO FIJO</strong></h1>

      <p>Entre FZERO S.R.L., representada por el Sr. Hernán Pellegrini, DNI nº 26.116.576, en su carácter de Socio Gerente, con domicilio legal en TRONADOR Nº 671, CABA (1428), en adelante “La Empleadora”; y el Sr/a. $crew_name_full, DNI Nº $crew_dni, CUIL $crew_cuit, con domicilio en $crew_addres_full, $crew_location($crew_cp), por la otra parte, en adelante “El Empleado” se celebra el presente contrato de trabajo de carácter a plazo fijo, sujeto a la legislación vigente (cf. arts. 8 y ccs.  CCT N° 634/11 SATSAID – CAPIT; 90, 93 y ss. y ccs. R.C.T.), y que se encuentra regulado por las siguientes cláusulas:</p>

      <p><strong>PRIMERA:</strong> La Empleadora contrata al Sr/a. <strong>$crew_name_full</strong>, y éste acepta desempeñarse como <strong>$crew_function_sat</strong>, en el proyecto ($center_cost) <strong>$crew_name_project</strong>.</p>

      <p><strong>SEGUNDA:</strong> El Empleado se compromete a cumplir con las obligaciones y tareas inherentes a sus funciones, prestando servicios durante los siguientes días y horarios: lunes a viernes durante 7 horas 15 minutos, los cuales podrán estar sujetos a modificaciones puntuales y/o circunstancias observadas por La Empleadora. Su lugar de trabajo será en Tronador 671, CABA, pudiendo modificarse por indicación de La Empleadora.</p>

      <p><strong>TERCERA:</strong> La contratación de El Empleado por el plazo del presente acuerdo obedece a la necesidad de realizar tareas de $crew_function_sat.</p>
      <p>El Empleado se notifica y consiente expresamente que su contratación es de naturaleza especial en razón de necesidades operacionales extraordinarias de La Empleadora en dicho Proyecto. Dada su magnitud y cantidad de personal técnico especializado requeridos, no es viable para la Empleadora afrontarlo con su personal de planta permanente. Se trata de un requerimiento extraordinario de personal necesario para el Proyecto por el estricto plazo de vigencia detallado en el presente (conforme régimen de los arts. 93, 95 y ccs. Ley de Contrato de Trabajo y art. 8 CCT Nº 634/11 SATSAID – CAPIT).</p>
      <p>Una vez finalizados los motivos que dieron lugar a su celebración, el contrato de trabajo se considerará extinguido de pleno derecho en los términos del artículo 73 y 74 de la Ley 24.013.</p>
      <p>El Empleado cumplirá las tareas propias de su oficio bajo las instrucciones emanadas del personal directivo de La Empleadora o de quienes ésta indique, debiendo respetarlas y cumplirlas con idoneidad, eficacia y diligencia.</p>
      <p>El Empleado se desempeñará con dedicación exclusiva y “full-time”, en los términos  y condiciones generales acordados en el presente, y los que se pudieran oportunamente convenir entre las Partes en particular para proyectos y trabajos específicos.</p>

      <p><strong>CUARTA:</strong> Se acuerda que el Sr/a. <strong>$crew_name_full</strong> percibirá una remuneración bruta de Pesos $crew_salary ($crew_salary_text), que se abonará en forma mensual, por período vencido del 1 al 5 de cada mes.</p>
      <p>Régimen de horas extras y francos a convenir en función de las exigencias de los servicios y conforme la normativa citada; presentismo a liquidarse según pautas del cit. CCT Nº 634/11.</p>

      <p><strong>QUINTA:</strong> El plazo de vigencia del presente contrato será a partir del día $crew_start_contract, y hasta el día $crew_finish_contract.</p>

      <p><strong>SEXTA:</strong> El Empleado cumplirá las tareas propias de su oficio bajo las directivas emanadas del personal directivo de La Empleadora o de quienes ésta indique, debiendo respetarlas y cumplirlas con idoneidad y diligencia.</p>
      <p>Una vez concluido el plazo señalado cesará la relación laboral. El Empleado a la finalización del contrato percibirá los salarios que se hubieran devengado, los importes proporcionales por eventuales vacaciones no gozadas y sueldo anual complementario.</p>

      <p><strong>SEPTIMA:</strong> Para todos los efectos emergentes del presente contrato, las partes constituyen domicilios en los indicados en el encabezamiento, donde se tendrán por válidas  y realizadas todas las comunicaciones que se cursaren hasta tanto no notifiquen en forma fehaciente la constitución de un nuevo domicilio a los mismos efectos.</p>

      <p><strong>OCTAVA:</strong> Notificaciones:Comunicaciones vía email.</p>
      <p>Las comunicaciones relacionadas con la ejecución operativa de este contrato de trabajo a plazo fijo se cursarán vía email (con constancia de entrega y constancia de recepción), a las siguientes direcciones:</p>
      <p>Comunicaciones a domicilios:</p>
      <p>Se dirigirán a los siguientes domicilios:</p>
      <p>A la Empleadora: Hernan Pellegrini (hernan.pellegrini@frame.com.ar)</p>
      <p>A El Empleado: <strong>$crew_name_full ($crew_email)</strong></p>

      <p><strong>NOVENA:</strong> El Empleado acepta y reconoce que La Empleadora y sus subsidiarias, sucesores, cesionarios y licenciatarios tendrán el derecho y la propiedad exclusiva de todos los resultados y los productos de sus Servicios en cualquier etapa de desarrollo y que los derechos exclusivos de La Empleadora  incluyen, sin limitación, el derecho de autor y derechos conexos, el derecho de reproducción, el derecho de adaptación, el derecho de traducción, el derecho de doblaje y subtitulado, el derecho de exhibición, el derecho de promoción, el derecho de comunicación pública, el derecho de distribución, el derecho de crear obras derivadas y el derecho de alquilar y/o licenciar el Trabajo, libre de todo gravamen, reclamo y/o cargo. Sin que ello signifique limitar lo antedicho, acepto y reconozco que en el futuro pueden surgir o reconocerse nuevos derechos sobre el Trabajo conforme a las leyes aplicables y/o bajo cualquier sistema jurídico (en adelante, los “Nuevos Derechos de Explotación”) y tengo la voluntad y por el presente le otorgo y cedo a La Empleadora todos y cada uno de tales Nuevos Derechos de Explotación en y sobre el Trabajo.</p>

      <p><strong>DECIMA:</strong> El Empleado entiende que durante la prestación de sus Servicios, podrá tener acceso a cierta información o material de propiedad de o relacionada con La Empleadora que no sea accesible o conocida por el público en general (“Información Confidencial”). Con respecto a ello, El Empleado conviene que: (a) no utilizará, directa ni indirectamente, la Información Confidencial para ningún fin ajeno al cual fue contratado, y que (b) no divulgará, directa ni indirectamente, dicha Información Confidencial a ninguna persona, empresa, sociedad, asociación u otra entidad por ninguna razón o propósito. A su vez  entiende que cualquier violación o intento de violación a las condiciones precedentes podría causar a La Empleadora un daño irreparable y en consecuencia, La Empleadora tendrá derecho a solicitar las medidas precautorias que estime pertinentes.</p>

      <p>En prueba de conformidad, se firman dos ejemplares de un mismo tenor y a un solo efecto, en la Ciudad de Buenos Aires, el día $today</p>

      <ul>
        <li>Firma:</li>
        <li>Aclaración: <strong>$crew_name_full</strong></li>
        <li>DNI: <strong>$crew_dni</strong></li>
      </ul>";

      return $message;
    }

    static public function getContractServicio($crew_name_full, $crew_addres_full, $crew_location, $crew_cp, $crew_dni, $crew_start_contract, $crew_finish_contract, $crew_function_sat, $crew_salary_text, $crew_salary, $crew_name_project, $crew_email)
    {
      $today = date('d/m/Y');

      $message = "<h1 style='font-size: 20px;'><strong>CONTRATO DE SERVICIOS</strong></h1>

      <p>Entre el/la Sra. $crew_name_full,  DNI Nº $crew_dni, con domicilio en $crew_addres_full, $crew_location($crew_cp), en adelante El Locador; y FZERO S.R.L., representada por el Sr. Hernán Pellegrini, DNI Nº 26.116.576, en su carácter de Socio Gerente, con domicilio en Tronador Nº 671, CABA (1427), en adelante La Locataria, convienen en celebrar el presente contrato de locación de servicios, que se regirá por las cláusulas que a continuación se expresan y por lo establecido en los arts. arts. 1251 y ss. y ccs. del Código Civil y Comercial.</p>

      <p><strong>PRIMERA: El Locador</strong> se compromete a la prestación específica del siguiente servicios, sin que esta mención importe la negación de otras conducentes a los fines contratados a favor de La Locataria: $crew_function_sat para el proyecto: “{$crew_name_project}”.</p>

      <p><strong>SEGUNDA:</strong> El presupuesto total por todo concepto acordado por las partes por la prestación del servicio detallado en la cláusula anterior, asciende a la suma de Pesos $crew_salary_text ($crew_salary), brutos.</p>
      <p><strong>La Locataria </strong> avisará de forma fehaciente al mail <strong>El Locador</strong> el día y horario de las jornada comprendidas dentro de las fechas de este contrato.</p>
      <p>Las comunicaciones relacionadas con la ejecución operativa de este contrato de trabajo a plazo fijo se cursarán vía email (con constancia de entrega y constancia de recepción), a las siguientes direcciones:</p>
      <p>Comunicaciones a domicilios:</p>
      <p>Se dirigirán a los siguientes domicilios:</p>
      <p>A la Empleadora: Hernan Pellegrini (hernan.pellegrini@frame.com.ar)</p>
      <p>A El Empleado: <strong>$crew_name_full ($crew_email)</strong></p>

      <p><strong>TERCERA:</strong> El plazo de la presente locación se acuerda –en principio- desde el $crew_start_contract venciendo el $crew_finish_contract pudiendo prorrogarse de común acuerdo entre las partes con 7 (siete) días de antelación a su vencimiento, en los términos y condiciones que entonces establezcan. Cualquiera de las partes podrá resolver el presente, notificando tal determinación por medio de un e-mail con quince (15) días corridos de anticipación. Producida la notificación, las partes tendrán quince (15) días para el cumplimiento de todas las obligaciones recíprocas pendientes a la fecha de resolución.</p>

      <p><strong>CUARTA: El Locador</strong> cumplirá con sus servicios de acuerdo al detalle de condiciones y pautas contenido en este contrato conformado, a plena satisfacción de <strong>La Locataria.</strong> Los servicios se prestarán a ciencia y conciencia <strong>El Locador</strong> quien deberá actuar dentro de las prescripciones éticas y legales que hacen a su disciplina u oficio profesional, siempre teniendo en mira y finalidad el objeto del presente convenio y de la contratación de sus servicios efectuada por <strong>La Locataria.</strong></p>

      <p><strong>QUINTA: El Locador</strong> se obliga a informar a <strong>La Locataria</strong> sobre el cumplimiento de la encomienda, con debido detalle: vía e-mail. Se deja expresamente aclarado que <strong>El Locador</strong> se ajustára estrictamente a las instrucciones y directivas que <strong>La Locataria</strong> le provea, por lo tanto de existir errores u omisiones, será de exclusiva responsabilidad El Locador.</p>

      <p><strong>SEXTA: El Locador</strong> acepta y reconoce que <strong>La Locataria</strong> y sus subsidiarias, sucesores, cesionarios y licenciatarios tendrán el derecho y la propiedad exclusiva de todos los resultados y los productos de sus Servicios en cualquier etapa de desarrollo y que los derechos exclusivos de <strong>La Locataria</strong> incluyen, sin limitación, el derecho de autor y derechos conexos, el derecho de reproducción, el derecho de adaptación, el derecho de traducción, el derecho de doblaje y subtitulado, el derecho de exhibición, el derecho de promoción, el derecho de comunicación pública, el derecho de distribución, el derecho de crear obras derivadas y el derecho de alquilar y/o licenciar el Trabajo, libre de todo gravamen, reclamo y/o cargo. Sin que ello signifique limitar lo antedicho, acepto y reconozco que en el futuro pueden surgir o reconocerse nuevos derechos sobre el Trabajo conforme a las leyes aplicables y/o bajo cualquier sistema jurídico (en adelante, los “Nuevos Derechos de Explotación”) y tengo la voluntad y por el presente le otorgo y cedo a <strong>La Locataria</strong>  todos y cada uno de tales Nuevos Derechos de Explotación en y sobre el Trabajo.</p>

      <p><strong>SÉPTIMA: El Locador</strong> entiende que durante la prestación de sus Servicios, podrá tener acceso a cierta información o material de propiedad de o relacionada con <strong>La Locataria</strong> que no sea accesible o conocida por el público en general (“Información Confidencial”). Con respecto a ello <strong>El Locador</strong> conviene que: (a) no utilizará, directa ni indirectamente, la Información Confidencial para ningún fin ajeno al cual fue contratado, y que (b) no divulgará, directa ni indirectamente, dicha Información Confidencial a ninguna persona, empresa, sociedad, asociación u otra entidad por ninguna razón o propósito. A su vez  entiende que cualquier violación o intento de violación a las condiciones precedentes podría causar a <strong>La Locataria</strong> un daño irreparable y en consecuencia, <strong>La Locataria</strong> tendrá derecho a solicitar las medidas precautorias que estime pertinentes.</p>

      <p><strong>OCTAVA:</strong> El presente contrato es total y absolutamente intransferible por <strong>El Locador</strong>, a ningún efecto y por ninguna causa.</p>

      <p><strong>NOVENA: La Locataria</strong> podrá declarar rescindido el contrato en los siguientes casos: A) Cuando <strong>El Locador</strong> no dé cumplimiento a las observaciones efectuadas por <strong>La Locataria</strong>, no cumpliese con las condiciones del contrato y comprometiese sus intereses. B) Si <strong>El Locador</strong> incumpliera con la fecha de terminación de los servicios contratados (sin perjuicio de la facultad de <strong>La Locataria</strong> estipulada en la Cláusula Tercera). En caso de rescisión imputable al <strong>Locador</strong>, <strong>La Locataria</strong> se reserva el derecho de reclamar los daños y perjuicios emergentes de su incumplimiento.</p>

      <p><strong>DECIMA:</strong> Para todos los efectos del presente contrato, las partes se someten a la competencia y jurisdicción de la Justicia Nacional en lo Civil con asiento en la Ciudad de Buenos Aires, renunciando expresamente a todo otro fuero o jurisdicción, constituyendo domicilios en los indicados en el encabezamiento, donde se tendrán por válidas y realizadas todas las notificaciones que se cursen hasta tanto no notifiquen en forma fehaciente la constitución de un nuevo domicilio a los mismos efectos.</p>
      <p>En prueba de conformidad, se firman dos ejemplares de un mismo tenor y a un solo efecto, en la Ciudad de Buenos Aires, el dia $today</p>

      <ul>
        <li>Firma:</li>
        <li>Aclaración: <strong>$crew_name_full</strong></li>
        <li>DNI: <strong>$crew_dni</strong></li>
      </ul>";

      return $message;
    }

    static public function getContractTiempoIndeterminado($crew_name_full, $crew_addres_full, $crew_location, $crew_cp, $crew_dni, $crew_cuit, $crew_function_sat, $crew_salary_text, $crew_salary, $crew_email)
    {
      $today = date('d/m/Y');

      $message = "<h1 style='font-size: 20px;'><strong>CONTRATO TIEMPO INDETERMINADO</strong></h1>

      <p>Entre FZERO S.R.L., representada por el Sr. Hernán Pellegrini, DNI nº 26.116.576, en sucarácter de Socio Gerente, con domicilio legal en Tronador 671, CABA (1427), enadelante LA EMPLEADORA; y el Sr/a. $crew_name_full,  DNI Nº $crew_dni, CUIL $crew_cuit, con domicilio en $crew_addres_full, $crew_location($crew_cp), por la otra parte, en adelante “El Empleado”  se celebra el presente contrato de trabajo por tiempo indeterminado, sujeto a la legislación vigente (cf. ley 20744 to; CCT N° 634/11 SATSAID – CAPIT), y conforme a los siguientes términos que convienen las partes:</p>

      <p><strong>PRIMERA:</strong> La Empleadora contrata al Sr. <strong>$crew_name_full</strong> y éste acepta desempeñarse como $crew_function_sat .</p>

      <p><strong>SEGUNDA:</strong></p>
      <p><strong>2.1</strong> El Empleado se compromete a cumplir con las obligaciones y tareas inherentes a sus funciones, prestando servicios durante los siguientes días y horarios: lunes a viernes durante 7 horas 15 minutos, los cuales podrán estar sujetos a modificaciones puntuales y/o circunstancias observadas por La Empleadora. Su lugar de trabajo será en Tronador CABA, pudiendo modificarse por indicación de La Empleadora.</p>
      <p>Las Partes acuerdan que dichos horarios podrán estar sujetos a modificaciones y/o circunstancias observadas por La Empleadora, prestando desde ya expresa conformidad con las mismas.</p>

      <p><strong>2.2</strong> El lugar de trabajo de El Empleado será en Tronador 671, CABA y/o los lugares que La Empleadora indique.</p>
      <p>El Empleado queda obligado a presentarse puntualmente en los lugares y horarios de prestación de sus tareas que le sean indicados por La Empleadora.</p>

      <p><strong>TERCERA:</strong> La contratación de El Empleado se realiza por tiempo indeterminado, para su incorporación como personal de planta permanente de La Empleadora, en los términos de la ley 20.744 (to)/LCT; CCT Nº 634/11 SATSAID – CAPIT, y normativa de aplicación, y sujeto a lo convenido en el siguiente párrafo.</p>
      <p>Se acuerda la celebración del presente contrato a prueba durante sus primeros tres (3) meses de vigencia, en los términos y condiciones del art. 92 bis y ccs. LCT.</p>

      <p><strong>CUARTA:</strong> Se acuerda que el Sr/a. <strong>$crew_name_full</strong> percibirá una remuneración bruta de Pesos $crew_salary_text ($crew_salary), que se abonará en forma mensual, por período vencido del 1 al 5 de cada mes.</p>
      <p>Régimen de horas extras y francos a convenir en función de las exigencias de los servicios y conforme la normativa citada; presentismo a liquidarse según pautas del cit. CCT Nº 634/11.</p>

      <p><strong>QUINTA:</strong> El Empleado cumplirá las tareas propias de su oficio bajo las instrucciones emanadas del personal directivo de La Empleadora o de quienes ésta indique, debiendo respetarlas y cumplirlas con idoneidad, eficacia y diligencia.</p>
      <p>El Empleado se desempeñará con dedicación exclusiva y “full-time”, en los términos y condiciones generales acordados en el presente, y los que se pudieran oportunamente convenir entre las Partes en particular para proyectos y trabajos específicos.</p>

      <p><strong>SEXTA:</strong> Notificaciones:Comunicaciones vía email.</p>
      <p>Las comunicaciones relacionadas con la ejecución operativa de este contrato de trabajo a tiempo indeterminado se cursarán vía email (con constancia de entrega y constancia de recepción), a las siguientes direcciones:</p>
      <p>Comunicaciones a domicilios:</p>
      <p>Se dirigirán a los siguientes domicilios:</p>
      <p>A la Empleadora: Hernan Pellegrini (hernan.pellegrini@frame.com.ar)</p>
      <p>A El Empleado: <strong>$crew_name_full ($crew_email)</strong></p>

      <p><strong>SÉPTIMA:</strong> El Empleado acepta y reconoce que La Empleadora y sus subsidiarias, sucesores, cesionarios y licenciatarios tendrán el derecho y la propiedad exclusiva de todos los resultados y los productos de sus Servicios en cualquier etapa de desarrollo y que los derechos exclusivos de La Empleadora  incluyen, sin limitación, el derecho de autor y derechos conexos, el derecho de reproducción, el derecho de adaptación, el derecho de traducción, el derecho de doblaje y subtitulado, el derecho de exhibición, el derecho de promoción, el derecho de comunicación pública, el derecho de distribución, el derecho de crear obras derivadas y el derecho de alquilar y/o licenciar el Trabajo, libre de todo gravamen, reclamo y/o cargo. Sin que ello signifique limitar lo antedicho, acepto y reconozco que en el futuro pueden surgir o reconocerse nuevos derechos sobre el Trabajo conforme a las leyes aplicables y/o bajo cualquier sistema jurídico (en adelante, los “Nuevos Derechos de Explotación”) y tengo la voluntad y por el presente le otorgo y cedo a La Empleadora todos y cada uno de tales Nuevos Derechos de Explotación en y sobre el Trabajo.</p>

      <p><strong>OCTAVA:</strong> El Empleado entiende que, durante la prestación de sus Servicios, podrá tener acceso a cierta información o material de propiedad de o relacionada con La Empleadora que no sea accesible o conocida por el público en general (“Información Confidencial”). Con respecto a ello, El Empleado conviene que: (a) no utilizará, directa ni indirectamente, la Información Confidencial para ningún fin ajeno al cual fue contratado, y que (b) no divulgará, directa ni indirectamente, dicha Información Confidencial a ninguna persona, empresa, sociedad, asociación u otra entidad por ninguna razón o propósito. A su vez  entiende que cualquier violación o intento de violación a las condiciones precedentes podría causar a La Empleadora un daño irreparable y en consecuencia, La Empleadora tendrá derecho a solicitar las medidas precautorias que estime pertinentes.</p>

      <p><strong>NOVENA:</strong> Para todos los efectos emergentes del presente contrato, las partes constituyen domicilios en los indicados en el encabezamiento, donde se tendrán por válidas y realizadas todas las comunicaciones que se cursaren hasta tanto no notifiquen en forma fehaciente la constitución de un nuevo domicilio a los mismos efectos.</p>

      <p>En prueba de conformidad, se firman dos ejemplares de un mismo tenor y a un solo efecto, en la Ciudad de Buenos Aires, en el día $today</p>

      <ul>
        <li>Firma:</li>
        <li>Aclaración: <strong>$crew_name_full</strong></li>
        <li>DNI: <strong>$crew_dni</strong></li>
      </ul>";

      return $message;
    }

    static public function getRelease($crew_name_full, $crew_birthdate, $crew_name_project, $crew_function_sat, $crew_start_contract, $name_contract)
    {
      $message = "<h1 style='font-size: 20px; text-decoration: underline'><strong>ACUERDO DE TITULARIDAD DE LA OBRA</strong></h1>

      <table style='border: 2px #000000 solid;'>
        <tr><td><strong>Nombre: $crew_name_full</strong></td></tr>
        <tr><td><strong>Fecha de Nacimiento: $crew_birthdate</strong></td></tr>
        <tr><td><strong>Proyecto: $crew_name_project</strong></td></tr>
        <tr><td><strong>Servicios (“ $name_contract ”): $crew_function_sat</strong></td></tr>
        <tr><td><strong>Fecha: $crew_start_contract</strong></td></tr>
      </table>

      <p>En consideración de la contraprestación, cuya suficiencia y recepción se reconocen en el presente, con relación a mi designación por parte de FZERO S.R.L. (el “<strong>CONTRATISTA</strong>”) para prestar Servicios en beneficio de FZERO S.R.L.(“FZERO”), por el presente acepto y reconozco que FZERO S.R.L. y sus subsidiarias, sucesores, cesionarios y licenciatarios (conjuntamente denominados “FZERO”) tendrán el derecho y la propiedad exclusiva de todos los resultados y los productos de mis Servicios en cualquier etapa de desarrollo (el “<strong>Trabajo</strong>”) y que los derechos exclusivos de FZERO S.R.L. incluyen, sin limitación, el derecho de autor y derechos conexos, el derecho de reproducción, el derecho de adaptación, el derecho de traducción, el derecho de doblaje y subtitulado, el derecho de exhibición, el derecho de promoción, el derecho de comunicación pública, el derecho de distribución, el derecho de crear obras derivadas y el derecho de alquilar y/o licenciar el Trabajo, libre de todo gravamen, reclamo y/o cargo (los “<strong>Derechos</strong>”).</p>

      <p>El Trabajo se considerará un “trabajo por encargo” solicitado especialmente por FZERO S.R.L. y FZERO S.R.L. será considerado el autor exclusivo del Trabajo y el titular exclusivo de los Derechos sobre éste.</p>

      <p>Sin que ello signifique limitar lo antedicho, acepto que los Derechos incluyen, pero no se limitan a: el derecho de explotar (o no explotar) el Trabajo y todos los resultados de los Servicios, a perpetuidad, o durante el máximo período permitido por las leyes aplicables, en todo el universo, en cualquier idioma, en todos los medios, formas y tecnologías existentes o que puedan existir el futuro, en cualquier etapa de desarrollo (en adelante los “<strong>Métodos de Explotación</strong>”), incluyendo, sin limitación: cines; teatros; televisión, incluyendo, sin limitarse a, analógica y digital, terrestre, por cable, satelital, de alta definición, televisión por protocolo de Internet (“IPTV”), y la retransmisión de cualquiera de los citados formatos televisivos mediante dispositivos inalámbricos (location free) o de acceso remoto, interactivos, pagos, gratuitos, pay per view, videos a la carta (video on demand), videos a la carta gratuitos (free video on demand), símiles videos a la carta (near video on demand), videos a la carta por suscripción (subscription video on demand);
      todas las formas de explotación de video lineales e interactivas, incluyendo, sin limitación, cintas de video (por ejemplo VHS, DAT), discos ópticos (por ejemplo DVD, Blu-Ray, HD-DVD, DVD de alta densidad y cualquier otro tipo de discos de alta densidad, discos compactos de video y discos láser), decodificadores, DVR, PVR y otros dispositivos o sistemas que soporten servicios de menús “desplegables” (push down) y “plegables” (pull down); contenidos adicionales y menús de navegación; productos, medios y servicios de computación e interactivos (incluso juegos) incluyendo, pero sin limitarse a, CD-ROM, DVD-ROM, Internet (y otros formatos de entrega y transmisión de paquetes de datos), ethernet, banda ancha, dispositivos inalámbricos y/o celulares (incluyendo, sin limitarse a, teléfonos, computadores, asistentes de datos personales y dispositivos personales y portátiles); bases de datos de servidores de medios; consolas de video juegos incluyendo, pero sin limitarse a, sistemas de almacenamiento ópticos, sistemas a cartucho, sistemas de videojuegos de mano;
      todas las formas de explotación fonográfica o de audio, incluyendo, pero sin limitarse a, CD, CD-Plus, CD-Extra, mini-Disc, DVD Audio, DAT, casetes; todas las formas de audio digital y archivos computarizados, servicios de música por cable, satelital y por Internet, reproducción en tiempo real (streaming) y descarga (downloading), en cualquier formato (por ejemplo bandas sonoras, simples, compilaciones); ringtones (tonos de llamada monofónicos y/o polifónicos), tonos reales (realtones), ringbacktones, ringtones de video; productos, chips y software de redes de computadoras; sonido y audio digital y transferencias de video incluyendo, pero sin limitarse a, reproducción en tiempo real (streaming) y descargas (downloading) en cualquier formato o codificación (codec); otros servicios multimedia, interactivos, a la carta u online, independientemente de su tipo de plataforma o método de almacenamiento o transmisión; no teatrales, incluyendo, sin limitarse a, entretenimiento a bordo, en cruceros y hoteles; todas las formas de radio;
      actuaciones en vivo y presentaciones en público o privadas (por ejemplo, shows en escenarios, shows sobre hielo, parques temáticos, centros comerciales); todas las formas de productos de consumo y publicaciones (incluyendo, envases) para los cuales se usen contenidos impresos o grabados, incluyendo, sin limitarse a, libros, revistas, libros y juguetes que hablen/canten, karaoke, productos educativos, video juegos; y publicidades y promociones, incluyendo, sin limitarse a, clips de audio y video, “pop ups”, avances, publicidad gráfica, comerciales, infomerciales, y promociones conjuntas de productos o servicios relacionados o no, independientemente del método o modo de entrega o transmisión.</p>

      <p>Acepto y reconozco que en el futuro pueden surgir o reconocerse nuevos derechos sobre el Trabajo conforme a las leyes aplicables y/o bajo cualquier sistema jurídico (en adelante, los “<strong>Nuevos Derechos de Explotación</strong>”) y tengo la voluntad y por el presente le otorgo y cedo a FZERO S.R.L. todos y cada uno de tales Nuevos Derechos de Explotación en y sobre el Trabajo.</p>

      <p>Tengo conocimiento y, por el presente, acepto que nuevos (o modificados) (1) usos, (2) tecnologías, (3) medios, (4) formatos, (5) modos de transmisión y (6) métodos de distribución, difusión, exhibición o representación (en adelante, los “<strong>Nuevos Derechos de Explotación</strong>”) se están desarrollando y continuarán, inevitablemente, desarrollándose en el futuro, los cuales brindarán nuevas oportunidades para explotar el Trabajo y tengo la voluntad y por el presente le otorgo y cedo a FZERO S.R.L. todos y cada uno de los Derechos y los Nuevos Derechos de Explotación sobre dichos Nuevos Métodos de Explotación.</p>

      <p>En caso de que el Trabajo en su totalidad o parcialmente no se considere “trabajo por encargo” por el presente cedo y/u otorgo a FZERO S.R.L. todos los derechos de cualquier naturaleza actualmente conocidos o que en adelante pudieran surgir en relación con el Trabajo, incluyendo sin limitarse a, los Derechos y/o los Nuevos Derechos de Explotación, en todo el universo, a perpetuidad, (o por el mayor período autorizado por las leyes aplicables, si fuere más corto), en todos los idiomas y para todos los medios existentes o por crearse, incluyendo sin limitación, los Métodos de Explotación y/o los Nuevos Métodos de Explotación y sin que ello genere derecho a pago de regalía alguna.</p>

      <p>En caso de que cualquiera de los Derechos y/o Nuevos Derechos de Explotación no fuera irrevocablemente cedido o de otro modo transferido a FZERO S.R.L., por el presente otorgo una licencia a FZERO S.R.L. sobre todos los derechos, incluyendo sin limitarse a, los Derechos y/o los Nuevos Derechos de Explotación, en todo el universo, a perpetuidad, (o por el mayor período autorizado por las leyes aplicables, si fuere más corto), en todos los idiomas y para todos los medios existentes o por crearse, incluyendo sin limitación, los Métodos de Explotación y/o los Nuevos Métodos de Explotación y sin que ello genere derecho a pago de regalía alguna.</p>

      <p>Acepto y ratifico que no me opondré ni interferiré con los Derechos de FZERO, la validez de este instrumento o la transferencia de Derechos, acuerdos u otras estipulaciones de este instrumento. Acuerdo suscribir todos los documentos y realizar todos los actos que FZERO S.R.L. considere necesarios a los efectos de perfeccionar este instrumento, confirmar la existencia del mismo y de concretar mi voluntad de otorgar los Derechos a FZERO.</p>

      <p>Sin limitar la generalidad de lo antedicho, FZERO S.R.L. tendrá derecho a editar, alterar, agregar a, sustraer de, adaptar o de otra forma disponer de, el Trabajo, y bien a no hacer uso, o hacer uso total o parcial, del mismo según lo desee en cualquier momento y en base a su propio criterio y discreción.</p>

      <p>En este acto acuerdo indemnizar a FZERO S.R.L. contra todos los reclamos, acciones, pérdidas, daños y perjuicios, sentencias, responsabilidades y costos (inclusive los honorarios razonables de los abogados) que se originen en cualquier incumplimiento o presunto incumplimiento de este acuerdo, de mi parte. Acepto y reconozco que los recursos que poseo ante un eventual incumplimiento de FZERO S.R.L.se limitan al derecho a reclamar daños y perjuicios e irrevocablemente renuncio a cualquier tipo de medida precautoria y/o cautelar y/o urgente que permita preliminarmente impedir la comercialización, reproducción, comunicación, exhibición y/o cualquier otra forma de explotación del Trabajo.</p>

      <p>Renuncio y/o cedo a FZERO S.R.L. hasta el máximo permitido por la legislación aplicable los derechos morales actualmente reconocidos o que puedan reconocerse en el futuro, por costumbres, usos o leyes. Acuerdo que (i) no presentaré a FZERO, sus afiliadas y/o sucesoras, reclamo alguno basado en mi derecho moral a oponerme a cualquier tipo de modificación, revisión, deformación o alteración del Trabajo, siempre que mi honor o reputación no se vea afectado por las mismas; (ii) FZERO, sus afiliadas y/o sucesoras, determinarán el volumen, el tipo, la colocación y otros aspectos de los créditos que se me puedan otorgar en relación con la explotación del Trabajo; y (iii) FZERO S.R.L. tiene la
      facultad de decidir cuándo y cómo explotar el Trabajo. Las antedichas renuncias al derecho de presentar reclamos basados en el derecho de paternidad sobre el Trabajo y/o la integridad del mismo continuarán en vigencia durante todo el período de protección de los Derechos y los Nuevos Derechos de Explotación correspondientes. Acepto el uso de los Derechos por parte de FZERO S.R.L. o de aquellos terceros debidamente autorizados por FZERO S.R.L.</p>

      <p>Reconozco y acepto que la invalidez de algún término o alguna disposición del presente no afectará los restantes términos, los cuales continuarán en plena vigencia tal como si el término o la disposición no válida no formase parte de este instrumento.</p>

      <p>Entiendo que durante la prestación de mis Servicios, podré tener acceso a cierta información o material de propiedad de o relacionada con FZERO S.R.L. que no sea accesible o conocida por el público en general (“<strong>Información Confidencial</strong>”). Con respecto a ello convengo que: (a) no utilizaré, directa ni indirectamente, la Información Confidencial para ningún fin ajeno al cual fui contratado, y que (b) no divulgaré, directa ni indirectamente, dicha Información Confidencial a ninguna persona, empresa, sociedad, asociación u otra entidad por ninguna razón o propósito. A su vez entiendo que cualquier violación o intento de violación a las condiciones precedentes podría causar a FZERO S.R.L. un daño irreparable y en consecuencia, FZERO S.R.L. tendrá derecho a solicitar las medidas precautorias que estime pertinentes.</p>

      <p>Reconozco y acuerdo que, las marcas, logos, personajes y diseños y toda otra propiedad intelectual perteneciente a FZERO S.R.L.es extremadamente valiosa, y que un uso no autorizado o impropio de la misma podría causar un daño sustancial a FZERO S.R.L. Por lo tanto no los utilizaré ya sea en forma directa o indirecta o cualquier variación de los mismos (ya sea en forma individual, en conjunto o como parte de otra palabra o nombre) ni el nombre de cualquier compañía subsidiaria o afiliada de FZERO, como así tampoco ninguno de los personajes o diseños pertenecientes a FZERO o de alguna de sus compañías relacionadas, afiliadas o subsidiarias, en ninguna campaña de publicidad, promoción, comercio u otros comunicados o discusiones o para expresar o implicar algún tipo de endoso o prueba de mis Servicios o productos o de un tercero,
      aún después de la terminación de la prestación de mis Servicios, ya sea de cualquier forma o para cualquier propósito salvo expresa autorización de FZERO S.R.L. por escrito. La presente prohibición incluye sin que ello implique una limitación, los comunicados de prensa, materiales de comercialización y lista de clientes.</p>

      <p>Sin limitar nada de lo establecido más arriba, otorgo a FZERO S.R.L. el derecho a utilizar, directa o indirectamente, mi imagen, apariencia, fotografía, comentarios, nombre, acción y/o voz en relación con el Trabajo y/o los Servicios, incluyendo sin limitarse su promoción. Acuerdo participar en cualquier actividad promocional a la que sea invitado por FZERO, incluyendo pero no limitado a, conferencias de prensa, eventos públicos, etc.</p>

      <p>Por último, acuerdo que no seré acreedor de ninguna contraprestación adicional como consecuencia del ejercicio de los derechos otorgados en el presente.</p>

      <p>Certifico y declaro que he leído el texto precedente y entiendo acabadamente el significado y efecto del mismo y con la intención de quedar obligado legalmente firmo esta autorización a los _________ días del mes de _____________________ de_______________</p>

      <ul>
        <li>Firma:</li>
        <li>Aclaración: </li>
        <li>Documento de identidad N°: </li>
      </ul>";

      return $message;
    }
}
