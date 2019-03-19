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

    static public function getContractEventual($crew_name_full, $crew_addres_full, $crew_location, $crew_dni, $crew_start_contract, $crew_function_sat, $crew_salary_text, $crew_salary, $crew_name_project)
    {
      $message = "<h1 style='font-size: 20px;'><strong>CONTRATO DE TRABAJO EVENTUAL</strong></h1>

      <p>Entre la firma FZERO S.R.L., representada en este acto por el Sr. HERNAN PELLEGRINI, DNI N° 26.116.576, con domicilio en  Tronador Nº 671, CABA (1427), en adelante “la Empleadora” y el Sr/Sra $crew_name_full, con domicilio real en $crew_addres_full, $crew_location, DNI Nº $crew_dni, por la otra parte, en adelante “el Empleado” se celebra el presente convenio de trabajo de carácter eventual conforme lo establecido por los arts. 8 y ccs.  CCT N° 634/11 SATSAID – CAPIT, arts. 99 y ccs. ley 20.744, y 68 y ccs. ley 24.013, y sujeto a las siguientes cláusulas:</p>

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

    static public function getContractPlazoFijo($crew_name_full, $crew_addres_full, $crew_location, $crew_dni, $crew_start_contract, $crew_function_sat, $crew_salary_text, $crew_salary, $crew_name_project)
    {
      $message = "<h1 style='font-size: 20px;'><strong>CONTRATO DE TRABAJO EVENTUAL</strong></h1>

      <p>Entre la firma FZERO S.R.L., representada en este acto por el Sr. HERNAN PELLEGRINI, DNI N° 26.116.576, con domicilio en  Tronador Nº 671, CABA (1427), en adelante “la Empleadora” y el Sr/Sra $crew_name_full, con domicilio real en $crew_addres_full, $crew_location, DNI Nº $crew_dni, por la otra parte, en adelante “el Empleado” se celebra el presente convenio de trabajo de carácter eventual conforme lo establecido por los arts. 8 y ccs.  CCT N° 634/11 SATSAID – CAPIT, arts. 99 y ccs. ley 20.744, y 68 y ccs. ley 24.013, y sujeto a las siguientes cláusulas:</p>

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

    static public function getContractServicio($crew_name_full, $crew_addres_full, $crew_location, $crew_dni, $crew_start_contract, $crew_function_sat, $crew_salary_text, $crew_salary, $crew_name_project)
    {
      $message = "<h1 style='font-size: 20px;'><strong>CONTRATO DE TRABAJO EVENTUAL</strong></h1>

      <p>Entre la firma FZERO S.R.L., representada en este acto por el Sr. HERNAN PELLEGRINI, DNI N° 26.116.576, con domicilio en  Tronador Nº 671, CABA (1427), en adelante “la Empleadora” y el Sr/Sra $crew_name_full, con domicilio real en $crew_addres_full, $crew_location, DNI Nº $crew_dni, por la otra parte, en adelante “el Empleado” se celebra el presente convenio de trabajo de carácter eventual conforme lo establecido por los arts. 8 y ccs.  CCT N° 634/11 SATSAID – CAPIT, arts. 99 y ccs. ley 20.744, y 68 y ccs. ley 24.013, y sujeto a las siguientes cláusulas:</p>

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
}
