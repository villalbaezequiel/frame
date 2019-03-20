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
      return $contract->name;
    }

    static public function getContractEventual($crew_name_full, $crew_addres_full, $crew_location, $crew_cp, $crew_dni, $crew_start_contract, $crew_function_sat, $crew_salary_text, $crew_salary, $crew_name_project)
    {
      $message = "<h1 style='font-size: 20px;'><strong>CONTRATO DE TRABAJO EVENTUAL</strong></h1>

      <p>Entre la firma FZERO S.R.L., representada en este acto por el Sr. HERNAN PELLEGRINI, DNI N° 26.116.576, con domicilio en  Tronador Nº 671, CABA (1427), en adelante “la Empleadora” y el Sr/Sra $crew_name_full, con domicilio real en $crew_addres_full, $crew_location($crew_cp). DNI Nº $crew_dni, por la otra parte, en adelante “el Empleado” se celebra el presente convenio de trabajo de carácter eventual conforme lo establecido por los arts. 8 y ccs.  CCT N° 634/11 SATSAID – CAPIT, arts. 99 y ccs. ley 20.744, y 68 y ccs. ley 24.013, y sujeto a las siguientes cláusulas:</p>

      <p><strong>PRIMERA:</strong> La empleadora toma al empleado a partir del día <strong>$crew_start_contract</strong>, para que preste servicios en calidad de: <strong>$crew_function_sat</strong>. Su horario y jornada de trabajo serán los siguientes: de lunes a viernes durante 7 horas.</p>

      <p><strong>SEGUNDA:</strong> La remuneración bruta básica a percibir por el empleado será de Pesos $crew_salary_text ($crew_salary) por mes.</p>

      <p><strong>TERCERA:</strong> La eventualidad del presente contrato de trabajo surge de la necesidad de cubrir en forma extraordinaria y transitoria el puesto indicado, originado por la producción única y exclusiva del proyecto <strong>“{$crew_name_project}”.</strong></p>
      <p>Una vez finalizados los motivos que dieron lugar a su celebración, el contrato de trabajo se considerará extinguido de pleno derecho en los términos del artículo 73 y 74 de la Ley 24.013.</p>

      <p><strong>CUARTA:</strong> El empleado cumplirá las tareas propias de su oficio bajo las directivas emanadas del personal directivo de la empresa empleadora o de quienes indique, debiendo respetarlas y cumplirlas con idoneidad y diligencia.</p>

      <p><strong>QUINTA:</strong> El empleado acepta y reconoce que la empleadora y sus subsidiarias, sucesores, cesionarios y licenciatarios tendrán el derecho y la propiedad exclusiva de todos los resultados y los productos de sus Servicios en cualquier etapa de desarrollo y que los derechos exclusivos de la empleadora  incluyen, sin limitación, el derecho de autor y derechos conexos, el derecho de reproducción, el derecho de adaptación, el derecho de traducción, el derecho de doblaje y subtitulado, el derecho de exhibición, el derecho de promoción, el derecho de comunicación pública, el derecho de distribución, el derecho de crear obras derivadas y el derecho de alquilar y/o licenciar el Trabajo, libre de todo gravamen, reclamo y/o cargo. Sin que ello signifique limitar lo antedicho, acepto y reconozco que en el futuro pueden surgir o reconocerse nuevos derechos sobre el Trabajo conforme a las leyes aplicables y/o bajo cualquier sistema jurídico (en adelante, los “Nuevos Derechos de Explotación”) y tengo la voluntad y por el presente le otorgo y cedo a FZERO SRL  todos y cada uno de tales Nuevos Derechos de Explotación en y sobre el Trabajo.</p>

      <p><strong>SEXTA:</strong> El empleado entiende que durante la prestación de sus Servicios, podrá tener acceso a cierta información o material de propiedad de o relacionada con la empleadora que no sea accesible o conocida por el público en general (“Información Confidencial”). Con respecto a ello, el empleado conviene que: (a) no utilizará, directa ni indirectamente, la Información Confidencial para ningún fin ajeno al cual fue contratado, y que (b) no divulgará, directa ni indirectamente, dicha Información Confidencial a ninguna persona, empresa, sociedad, asociación u otra entidad por ninguna razón o propósito. A su vez  entiende que cualquier violación o intento de violación a las condiciones precedentes podría causar a la empleadora un daño irreparable y en consecuencia, la empleadora tendrá derecho a solicitar las medidas precautorias que estime pertinentes.</p>
      <p>PREVIA LECTURA Y RATIFICACION; se firman 2 (dos) ejemplares de un mismo tenor en la ciudad de Buenos Aires, a los $crew_start_contract.</p>

      <ul>
        <li>Firma:</li>
        <li>Aclaración:</li>
        <li>DNI:</li>
      </ul>";

      return $message;
    }

    static public function getContractPlazoFijo($crew_name_full, $crew_addres_full, $crew_location, $crew_cp, $crew_dni, $crew_start_contract, $crew_finish_contract, $crew_function_sat, $crew_salary_text, $crew_salary, $crew_name_project, $crew_email)
    {
      $message = "<h1 style='font-size: 20px;'><strong>CONTRATO PLAZO FIJO</strong></h1>

      <p>Entre FZERO S.R.L., representada por el Sr. Hernán Pellegrini, DNI nº 26.116.576, en su carácter de Socio Gerente, con domicilio legal en Federico Lacroze Nº 3621, CABA (1427), en adelante La Empleadora; y el Sr/a. $crew_name_full,  DNI Nº $crew_dni,  con domicilio en $crew_addres_full, $crew_location($crew_cp), se celebra el presente contrato de trabajo a plazo fijo, sujeto a la legislación vigente (cf. arts. 8 y ccs.  CCT N° 634/11 SATSAID – CAPIT; 90, 93 y ss. y ccs. R.C.T.), y que se encuentra regulado por las siguientes cláusulas:</p>

      <p><strong>PRIMERA:</strong> La Empleadora contrata al Sr/a. $crew_name_full, y éste acepta desempeñarse como <strong>$crew_function_sat</strong>.</p>

      <p><strong>SEGUNDA:</strong> El Sr/a. $crew_name_full se compromete a cumplir con las obligaciones y tareas inherentes a sus funciones, prestando servicios durante los siguientes días y horarios: lunes a viernes durante 7 horas, los cuales podrán estar sujetos a modificaciones puntuales y/o circunstancias observadas por La Empleadora. Su lugar de trabajo será en Tronador 671, CABA, pudiendo modificarse por indicación de La Empleadora.</p>

      <p><strong>TERCERA:</strong> La contratación del Sr/a. $crew_name_full por el plazo del presente acuerdo obedece a la necesidad de realizar tareas de $crew_function_sat.</p>

      <p><strong>CUARTA:</strong> El Sr/a. $crew_name_full percibirá una remuneración bruta con presentismo incluido de $crew_salary (Pesos $crew_salary_text), que se abonará en forma mensual, por período vencido del 1 al 5 de cada mes.</p>

      <p><strong>QUINTA:</strong> El plazo de vigencia del presente contrato será de 7 (siete) meses y 12 (doce) días, a partir del día $crew_start_contract, y hasta el día $crew_finish_contract.</p>

      <p><strong>SEXTA:</strong> El Sr. Héctor Carlos Becerini cumplirá las tareas propias de su oficio bajo las directivas emanadas del personal directivo de la Empleadora o de quienes ésta indique, debiendo respetarlas y cumplirlas con idoneidad y diligencia.</p>

      <p><strong>SEPTIMA:</strong> Para todos los efectos emergentes del presente contrato, las partes constituyen domicilios en los indicados en el encabezamiento, donde se tendrán por válidas  y realizadas todas las comunicaciones que se cursaren hasta tanto no notifiquen en forma fehaciente la constitución de un nuevo domicilio a los mismos efectos.</p>

      <p><strong>OCTAVA:</strong> Notificaciones:Comunicaciones vía email.</p>

      <p>Las comunicaciones relacionadas con la ejecución operativa de este contrato de trabajo a plazo fijo se cursarán vía email (con constancia de entrega y constancia de recepción), a las siguientes direcciones:</p>

      <p>Comunicaciones a domicilios:</p>

      <p>Se dirigirán a los siguientes domicilios:</p>

      <p>A la Empleadora: Hernan Pellegrini (hernan.pellegrini@frame.com.ar)</p>

      <p>A $crew_name_full ($crew_email)</p>

      <p><strong>NOVENA:</strong> El empleado acepta y reconoce que la empleadora y sus subsidiarias, sucesores, cesionarios y licenciatarios tendrán el derecho y la propiedad exclusiva de todos los resultados y los productos de sus Servicios en cualquier etapa de desarrollo y que los derechos exclusivos de la empleadora  incluyen, sin limitación, el derecho de autor y derechos conexos, el derecho de reproducción, el derecho de adaptación, el derecho de traducción, el derecho de doblaje y subtitulado, el derecho de exhibición, el derecho de promoción, el derecho de comunicación pública, el derecho de distribución, el derecho de crear obras derivadas y el derecho de alquilar y/o licenciar el Trabajo, libre de todo gravamen, reclamo y/o cargo. Sin que ello signifique limitar lo antedicho, acepto y reconozco que en el futuro pueden surgir o reconocerse nuevos derechos sobre el Trabajo conforme a las leyes aplicables y/o bajo cualquier sistema jurídico (en adelante, los “Nuevos Derechos de Explotación”) y tengo la voluntad y por el presente le otorgo y cedo a FZERO SRL  todos y cada uno de tales Nuevos Derechos de Explotación en y sobre el Trabajo.</p>

      <p><strong>DECIMA:</strong> El empleado entiende que durante la prestación de sus Servicios, podrá tener acceso a cierta información o material de propiedad de o relacionada con la empleadora que no sea accesible o conocida por el público en general (“Información Confidencial”). Con respecto a ello, el empleado conviene que: (a) no utilizará, directa ni indirectamente, la Información Confidencial para ningún fin ajeno al cual fue contratado, y que (b) no divulgará, directa ni indirectamente, dicha Información Confidencial a ninguna persona, empresa, sociedad, asociación u otra entidad por ninguna razón o propósito. A su vez  entiende que cualquier violación o intento de violación a las condiciones precedentes podría causar a la empleadora un daño irreparable y en consecuencia, la empleadora tendrá derecho a solicitar las medidas precautorias que estime pertinentes.</p>

      <p>En prueba de conformidad, se firman dos ejemplares de un mismo tenor y a un solo efecto, en la Ciudad de Buenos Aires, el día $crew_start_contract</p>

      <ul>
        <li>Firma:</li>
        <li>Aclaración:</li>
        <li>DNI:</li>
      </ul>";

      return $message;
    }

    static public function getContractServicio($crew_name_full, $crew_addres_full, $crew_location, $crew_cp, $crew_dni, $crew_start_contract, $crew_finish_contract, $crew_function_sat, $crew_salary_text, $crew_salary, $crew_name_project)
    {
      $message = "<h1 style='font-size: 20px;'><strong>CONTRATO DE SERVICIOS</strong></h1>

      <p>Entre el/la Sra. $crew_name_full,  DNI Nº $crew_dni, con domicilio en $crew_addres_full, $crew_location($crew_cp), en adelante El Locador; y FZERO S.R.L., representada por el Sr. Hernán Pellegrini, DNI Nº 26.116.576, en su carácter de Socio Gerente, con domicilio en Tronador Nº 671, CABA (1427), en adelante La Locataria, convienen en celebrar el presente contrato de locación de servicios, que se regirá por las cláusulas que a continuación se expresan y por lo establecido en los arts. arts. 1251 y ss. y ccs. del Código Civil y Comercial</p>

      <p><strong>PRIMERA: El Locador</strong> se compromete a la prestación específica del siguiente servicios, sin que esta mención importe la negación de otras conducentes a los fines contratados a favor de La Locataria: $crew_function_sat para el proyecto: “{$crew_name_project}”.</p>

      <p><strong>SEGUNDA:</strong> El presupuesto total por todo concepto acordado por las partes por la prestación del servicio detallado en la cláusula anterior, asciende a la suma de Pesos $crew_salary_text ($crew_salary) brutos por MENSUAL de trabajo.</p>

      <p><strong>La Locataria </strong> avisará de forma fehaciente al mail del Locador el día y horario de las jornada comprendidas dentro de las fechas de este contrato.</p>

      <p><strong>TERCERA:</strong> El plazo de la presente locación se acuerda –en principio- desde el $crew_start_contract venciendo el $crew_finish_contract pudiendo prorrogarse de común acuerdo entre las partes con 7 (siete) días de antelación a su vencimiento, en los términos y condiciones que entonces establezcan. Cualquiera de las partes podrá resolver el presente, notificando tal determinación por medio de un e-mail con quince (15) días corridos de anticipación. Producida la notificación, las partes tendrán quince (15) días para el cumplimiento de todas las obligaciones recíprocas pendientes a la fecha de resolución.</p>

      <p><strong>CUARTA: El Locador</strong> cumplirá con sus servicios de acuerdo al detalle de condiciones y pautas contenido en este contrato conformado, a plena satisfacción de <strong>La Locataria.</strong> Los servicios se prestarán a ciencia y conciencia del <strong>Locador</strong> quien deberá actuar dentro de las prescripciones éticas y legales que hacen a su disciplina u oficio profesional, siempre teniendo en mira y finalidad el objeto del presente convenio y de la contratación de sus servicios efectuada por <strong>La Locataria.</strong></p>

      <p><strong>QUINTA: El Locador</strong> se obliga a informar a <strong>La Locataria </strong> sobre el cumplimiento de la encomienda, con debido detalle: vía e-mail. Se deja expresamente aclarado que El Locador efectuará las labores ajustándose estrictamente a las instrucciones y directivas que <strong>La Locataria </strong> le provea, por lo tanto de existir errores u omisiones,  será de exclusiva responsabilidad del Locador.</p>

      <p><strong>SEXTA: El Locador</strong> acepta y reconoce que <strong>La Locataria </strong> y sus subsidiarias, sucesores, cesionarios y licenciatarios tendrán el derecho y la propiedad exclusiva de todos los resultados y los productos de sus Servicios en cualquier etapa de desarrollo y que los derechos exclusivos de <strong>La Locataria </strong> incluyen, sin limitación, el derecho de autor y derechos conexos, el derecho de reproducción, el derecho de adaptación, el derecho de traducción, el derecho de doblaje y subtitulado, el derecho de exhibición, el derecho de promoción, el derecho de comunicación pública, el derecho de distribución, el derecho de crear obras derivadas y el derecho de alquilar y/o licenciar el Trabajo, libre de todo gravamen, reclamo y/o cargo. Sin que ello signifique limitar lo antedicho, acepto y reconozco que en el futuro pueden surgir o reconocerse nuevos derechos sobre el Trabajo conforme a las leyes aplicables y/o bajo cualquier sistema jurídico (en adelante, los “Nuevos Derechos de Explotación”) y tengo la voluntad y por el presente le otorgo y cedo a FZERO SRL todos y cada uno de tales Nuevos Derechos de Explotación en y sobre el Trabajo.</p>

      <p><strong>SÉPTIMA: El Locador</strong> entiende que durante la prestación de sus Servicios, podrá tener acceso a cierta información o material de propiedad de o relacionada con <strong>La Locataria </strong> que no sea accesible o conocida por el público en general (“Información Confidencial”). Con respecto a ello El Locador conviene que: (a) no utilizará, directa ni indirectamente, la Información Confidencial para ningún fin ajeno al cual fue contratado, y que (b) no divulgará, directa ni indirectamente, dicha Información Confidencial a ninguna persona, empresa, sociedad, asociación u otra entidad por ninguna razón o propósito. A su vez  entiende que cualquier violación o intento de violación a las condiciones precedentes podría causar a <strong>La Locataria </strong> un daño irreparable y en consecuencia, <strong>La Locataria </strong> tendrá derecho a solicitar las medidas precautorias que estime pertinentes.</p>

      <p><strong>OCTAVA:</strong> El presente contrato es total y absolutamente intransferible por El Locador, a ningún efecto y por ninguna causa.</p>

      <p><strong>NOVENA: La Locataria</strong> podrá declarar rescindido el contrato en los siguientes casos: A) Cuando El Locador no dé cumplimiento a las observaciones efectuadas por La Locataria, no cumpliese con las condiciones del contrato y comprometiese sus intereses. B) Si El Locador incumpliera con la fecha de terminación de los servicios contratados (sin perjuicio de la facultad de <strong>La Locataria </strong> estipulada en la Cláusula Tercera). En caso de rescisión imputable al Locador, <strong>La Locataria </strong> se reserva el derecho de reclamar los daños y perjuicios emergentes de su incumplimiento.</p>

      <p><strong>DECIMA:</strong> Para todos los efectos del presente contrato, las partes se someten a la competencia y jurisdicción de la Justicia Nacional en lo Civil con asiento en la Ciudad de Buenos Aires, renunciando expresamente a todo otro fuero o jurisdicción, constituyendo domicilios en los indicados en el encabezamiento, donde se tendrán por válidas y realizadas todas las notificaciones que se cursen hasta tanto no notifiquen en forma fehaciente la constitución de un nuevo domicilio a los mismos efectos.</p>

      <p>En prueba de conformidad, se firman dos ejemplares de un mismo tenor y a un solo efecto, en la Ciudad de Buenos Aires, el día $crew_start_contract</p>

      <ul>
        <li>Firma:</li>
        <li>Aclaración:</li>
        <li>DNI:</li>
      </ul>";

      return $message;
    }
}
