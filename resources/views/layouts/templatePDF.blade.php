<div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_align_center ">
            <div class="tm_invoice_center tm_text_center">
              <div class="tm_primary_color tm_f50 tm_text_uppercase"><h3>Orden de Reparación</h3></div>
            </div>
            <table>
              <tbody>
                <tr>
                  <td>
                    <div class="tm_invoice_left">
                      <div class="tm_logo"><img src="{{ asset('assets/images/logo-muni.png') }}" alt="Logo" width="100"></div>
                    </div>
                  </td>
                  <td>
                    <div class="tm_invoice_left tm_text_left">
                      <p><b class="tm_primary_color">Dirección de Modernización</b></p>
                      <p>
                        Sarmiento N° 1856 <br>
                        San Fernando del Valle<br>
                        Capital CP: 4700 <br>
                        383-4657-544
                      </p>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tm_invoice_info tm_mb20">
            <div class="tm_invoice_seperator tm_gray_bg"></div>
            <div class="tm_invoice_info_list">
              <p class="tm_invoice_number tm_m0">Orden No: <b class="tm_primary_color">#{{ $order->id }}</b></p>
              @php
                $date = date_create($order->date_emission);
              @endphp
              <p class="tm_invoice_date tm_m0">Fecha de ingreso: <b class="tm_primary_color">{{ date_format($date, "d.m.y") }}</b></p>
            </div>
          </div>
          <div class="tm_invoice_head tm_mb10">
            <div class="tm_invoice_left">
              <p class="tm_mb2"><b class="tm_primary_color">Orden Para:</b></p>
              <p>
                {{ $order->customer->name }} <br>
                <strong>Teléfono: </strong>{{ $order->customer->phone }} <br>
                <strong>Area: </strong>{{ $order->customer->area->area_name }}
              </p>
            </div>
          </div>
          <div class="tm_table tm_style1 tm_mb30">
            <div class="tm_round_border">
              <div class="tm_table_responsive">
                <table>
                  <thead>
                    <tr>
                      <th class="tm_width_3 tm_semi_bold tm_primary_color tm_gray_bg">Información de Equipo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="tm_width_3">
                        <strong>Tipo de Equipo: </strong> {{ $order->device->typeDevice->type_name }} <br />
                        <strong>Marca: </strong> {{ $order->device->brand->brand_name }} <br />
                        <strong>N° Serie: </strong> {{ $order->device->serial_number }} <br />
                        <strong>Falla: </strong> {{ $order->report_customer }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tm_padd_15_20 tm_round_border">
            <p class="tm_mb5"><b class="tm_primary_color">Accesorios:</b></p>
            <ul class="tm_m0 tm_note_list">
              <li>No tiene.</li>
            </ul>
          </div><!-- .tm_note -->
          <br /><br /><br /><br /><br /><br />
          <div class="tm_invoice_footer">
            <div class="tm_left_footer">
              <p class="tm_mb2"><b class="tm_primary_color">Firma:</b></p>
              <p class="tm_m0">___________________________________________________</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>